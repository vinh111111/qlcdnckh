<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Requesttoview;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\Typeproject;
use App\Mail\SendMail;
use App\Models\Project;



class PageController extends Controller
{
    public function getHomepage()
    {
        $banners = Project::inRandomOrder()->limit(6)->get();
        $types = Typeproject::take(3)->get();
        $typeproject1 = Project::where('id_type',1)->where('status', 'Đã được duyệt')->orderBy('created_at', 'desc')->take(4)->get();
        $typeproject2 = Project::where('id_type',2)->where('status', 'Đã được duyệt')->orderBy('created_at', 'desc')->take(4)->get();
        $typeproject3 = Project::where('id_type',3)->where('status', 'Đã được duyệt')->orderBy('created_at', 'desc')->take(4)->get();
        return view('index', compact('typeproject1','typeproject2','typeproject3','banners','types'));
    }
    public function getTypepage($id)
    {
        $projects = Project::where('id_type', $id)->where('status', 'Đã được duyệt')->orderBy('created_at', 'desc')->paginate(10);
        $typeproject = Typeproject::where('id', $id)->get();
        return view('category', compact('projects'), array('typeproject' => $typeproject));
    }
    public function getProjectdetail($id)
    {
        $project = Project::where('id',$id)->first();
        return view('project-detail',compact('project'));
    }
    public function getAbout()
    {
        return view('about');
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        
        $projects = Project::where('status', 'Đã được duyệt')->orderBy('created_at', 'desc')->paginate(10);
        if ($search) {
            $results = $results = Project::where(function($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                      ->orWhere('implementer', 'LIKE', '%' . $search . '%')
                      ->orWhere('created_at', 'LIKE', '%' . $search . '%');
            })
            ->where('status', 'Đã được duyệt')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        } else {
            $results = null;
        }
        return view('category', compact('projects', 'results', 'search'));
    }
    public function getContact()
    {
        return view('contact');
    }
    public function postContact(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'msg' => 'required',
        ], [
            'name.required' => 'Bạn chưa nhập Họ tên',
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'Địa chỉ email không hợp lệ',
            'msg.required' => 'Bạn chưa nhập nội dung',
        ]);

        $sentData = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'message' => $request->input('msg'),
        ];
        // Gửi email cho bạn
        Mail::to('haphuocsang.dn2003@gmail.com')->send(new SendMail($sentData));

        return redirect()->route('getContact')->with('success', 'Gửi thành công!');
    }
    public function requestEmail($projectLinkType, $projectId)
    {
        return view('email-request', compact('projectLinkType', 'projectId'));
    }
    public function saveEmailContent(Request $request, $projectLinkType, $projectId)
    {
        $request->validate([
            'email' => 'required|email',
        ],
        [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Định dạng email không đúng ',
        ]);
        $userEmail = $request->input('email');
        $user = Auth::user();
        $project = Project::find($projectId);
        if (!$project) {
            return redirect()->back()->with('error', 'Dự án không tồn tại');
        }
        if ($project->status == 'Đã bị hủy') {
            return redirect()->back()->with('error', 'Dự án đã bị hủy, không thể xử lý yêu cầu');
        }
        $requesttoview = new Requesttoview();
        $requesttoview->id_user = $user->id;
        $requesttoview->id_project = $projectId;
        $requesttoview->email = $userEmail;
        switch ($projectLinkType) {
            case 'application_link':
                $link = $project->application_link;
                $type = 'ứng dụng';
                break;
            case 'report_link':
                $link = $project->report_link;
                $type = 'báo cáo';
                break;
            case 'product_link':
                $link = $project->product_link;
                $type = 'sản phẩm';
                break;
            default:
                $link = null;
                $type = 'Không xác định';
        }
        if (!$link) {
            return redirect()->back()->with('error', 'Link không tồn tại');
        }
        $requesttoview->link = $link;
        $requesttoview->type = $type;
        $requesttoview->status = "Đang chờ được duyệt";
        $requesttoview->save();

        $notification = new Notification();
        $notification->id_user = '1';
        $notification->id_project = $projectId;
        $notification->content = 'Yêu cầu duyệt xem '.$type.' từ '.$user->name;
        $notification->type = 'Duyệt xem';
        $notification->save();
        return redirect()->route('getProjectdetail', $projectId)->with('success', 'Yêu cầu của bạn đang chờ được duyệt');
    }
}
