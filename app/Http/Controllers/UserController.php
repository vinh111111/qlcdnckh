<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use App\Models\Requesttoview;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Typeproject;
use App\Models\Project;
use App\Models\User;

class UserController extends Controller
{
    public function getLogin()
    {
        return view('login');
    }
    public function postLogin(Request $req)
    {
        $this->validate(
            $req,
            [
                'email' => 'required|email',
                'password' => 'required|min:6|max:20'
            ],
            [
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Không đúng định dạng email',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'password.min' => 'Mật khẩu ít nhất 6 ký tự'
            ]
        );
        $credentials = array('email' => $req->email, 'password' => $req->password);
        if (Auth::attempt($credentials)) {
            return redirect('/admin/posts/admin-list-post')->with(['flag' => 'alert', 'message' => 'Đăng nhập thành công']);
        } else {
            return redirect()->back()->withInput()->with(['flag' => 'danger', 'message' => 'Đăng nhập không thành công. Kiểm tra lại thông tin đăng nhập.']);
        }
    }
    public function getLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('getLogin');
    }
    public function getMyprofile()
    {
        $user = Auth::user();
        return view('profile.profile', compact('user'));
    }
    public function postEditprofile(Request $request, $id)
    {
        $name = '';
        // Validate dữ liệu
        if ($request->hasfile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpg,png,gif,jpeg|max:2048',
                'email' => 'required|email',
                'name' => 'required',
                'phone' => 'required|min:10',
            ], [
                'image.image' => 'Chỉ chấp nhận file hình ảnh',
                'image.mimes' => 'Chỉ chấp nhận các định dạng hình ảnh: jpg, png, gif, jpeg',
                'image.max' => 'Chỉ chấp nhận hình ảnh dưới 2Mb',
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Không đúng định dạng email',
                'phone.required' => 'Phải nhập số điện thoại',
                'phone.min' => 'Số điện thoại ít nhất 10 kí tự',
                'name.required' => 'Chưa nhập họ tên',
            ]);
            $file = $request->file('image');
            $name = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('/theme/image/users'); //project\public\car, public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name);
        } 
        else {
            $request->validate([
                'email' => 'required|email',
                'name' => 'required',
                'phone' => 'required|min:10',
            ], [
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Không đúng định dạng email',
                'phone.required' => 'Phải nhập số điện thoại',
                'phone.min' => 'Số điện thoại ít nhất 10 kí tự',
                'name.required' => 'Chưa nhập họ tên',
            ]);
        }
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if ($name == '') {
            $name = $user->image;
        } else {
            $duongDanThuMuc = public_path('/theme/image/users');
            $tenTepTin = $user->image;
            if ($tenTepTin && File::exists($duongDanThuMuc . '/' . $tenTepTin)) {
                unlink($duongDanThuMuc . '/' . $tenTepTin);
            };
            $user->image = $name;
        }
        $user->save();
        return redirect()->route('getMyprofile')->with('success1', 'Cập nhật thông tin thành công!');
    }
    public function changepassword(Request $request, $id)
    {
        $user = User::find($id);
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|max:20',
            're_new_password' => 'required|same:new_password',
        ], [
            'old_password.required' => 'Vui lòng nhập mật khẩu hiện tại.',
            'new_password.required' => 'Vui lòng nhập mật khẩu mới.',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự.',
            'new_password.max' => 'Mật khẩu mới không được quá 20 ký tự.',
            're_new_password.same' => 'Mật khẩu xác nhận không khớp',
        ]);
        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->with('error', 'Mật khẩu hiện tại không chính xác.');
        }
        else{
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->back()->with('success2', 'Mật khẩu đã được thay đổi thành công.');
        }        
    }
    public function getPost(){
        $user = Auth::user();
        $id_user =$user->id;
        $projects = Project::where('id_user',$id_user)->where('status', 'Đã được duyệt')->orderBy('created_at', 'desc')->get();
        return view('posts.list-post',compact('projects'));
    }
    public function getPostAdd()
    {
        $typeprojects = Typeproject::All();
        return view('posts.add-post', compact('typeprojects'));
    }
    public function postPostAdd(Request $request)
    {   
        $name = '';
        $this->validate($request, [
            'image' => 'required|mimes:jpg,png,gif,jpeg|max:2048',
            'name' => 'required|unique:projects,name',
            'summary' => 'required',
            'implementer' => 'required',
            'report_link' => 'nullable|url',
            'product_link' => 'nullable|url',
            'application_link' => 'nullable|url',
        ], [
            'image.mimes' => 'Chỉ chấp nhận file hình ảnh',
            'image.max' => 'Chỉ chấp nhận hình ảnh dưới 2Mb',
            'image.required' => 'Bạn chưa chọn hình ảnh',
            'name.required' => 'Bạn chưa nhập tên sách',
            'name.unique' => 'Tên sách đã tồn tại',
            'summary.required' => 'Bạn chưa nhập giới thiệu',
            'implementer.required' => 'Bạn chưa nhập người thực hiện',
            'report_link.url' => 'Định dạng không hợp lệ cho đường link báo cáo',
            'product_link.url' => 'Định dạng không hợp lệ cho đường link sản phẩm',
            'application_link.url' => 'Định dạng không hợp lệ cho đường link ứng dụng',
        ]);        
        $file = $request->file('image');
        $name = time() . '_' . $file->getClientOriginalName();
        $destinationPath = public_path('/theme/image/project'); 
        $file->move($destinationPath, $name);
        $user = Auth::user();
        $id_user =$user->id;
        $projects = new Project();
        $projects->name = $request->name;
        $projects->summary = $request->summary;
        $projects->image = $name;
        $projects->id_user = $id_user;
        $projects->id_type = $request->id_type;
        $projects->implementer = $request->implementer;
        $projects->report_link = $request->report_link;
        $projects->product_link = $request->product_link;
        $projects->application_link = $request->application_link;
        $projects->status = 'Đang chờ xét duyệt';
        $projects->save();

        $id_project = $projects->id;

        $notification = new Notification();
        $notification->id_user = '1';
        $notification->id_project = $id_project;
        $notification->content = 'Yêu cầu được duyệt đề án từ '.$user->name;
        $notification->type = 'Đang chờ được duyệt';
        $notification->save();
        return redirect()->route('getPost')->with('success', 'Bạn đã gửi thành công!'); 
    }
    public function getPostEdit(string $id)
    {
        $project = Project::where('id', $id)->first();
        $typeprojects = Typeproject::All();
        return view('posts.edit-post', compact('typeprojects','project'));
    }
    public function postPostEdit(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'summary' => 'required',
            'implementer' => 'required',
            'report_link' => 'nullable|url',
            'product_link' => 'nullable|url',
            'application_link' => 'nullable|url',
        ], [
            'name.required' => 'Bạn chưa nhập tên sách',
            'summary.required' => 'Bạn chưa nhập giới thiệu',
            'implementer.required' => 'Bạn chưa nhập người thực hiện',
            'report_link.url' => 'Định dạng không hợp lệ cho đường link báo cáo',
            'product_link.url' => 'Định dạng không hợp lệ cho đường link sản phẩm',
            'application_link.url' => 'Định dạng không hợp lệ cho đường link ứng dụng',
        ]);

        $projects = Project::find($id);
        $projects->name = $request->name;
        $projects->summary = $request->summary;
        $projects->id_type = $request->id_type;
        $projects->implementer = $request->implementer;
        $projects->report_link = $request->report_link;
        $projects->product_link = $request->product_link;
        $projects->application_link = $request->application_link;

        if ($request->hasfile('image')) 
        {
            $this->validate($request, [
                'image' => 'required|mimes:jpg,png,gif,jpeg|max:2048',
            ], [
                'image.mimes' => 'Chỉ chấp nhận file hình ảnh',
                'image.max' => 'Chỉ chấp nhận hình ảnh dưới 2Mb',
                'image.required' =>'Bạn chưa chọn hình ảnh',
            ]);

            $file = $request->file('image');
            $name = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('/theme/image/project'); 
            $file->move($destinationPath, $name);
            if ($projects->image && File::exists($destinationPath . '/' . $projects->image)) {
                unlink($destinationPath . '/' . $projects->image);
            }
            $projects->image = $name;
        }

        $projects->save();
        return redirect()->route('getPost')->with('success', 'Bạn đã sửa thành công!');
    }
    public function deletetProject(string $id)
    {
        $project = Project::find($id);
        $duongDanThuMuc = public_path('/theme/image/project');
        $tenTepTin = $project->image;
        if ($tenTepTin && File::exists($duongDanThuMuc . '/' . $tenTepTin)) {
            unlink($duongDanThuMuc . '/' . $tenTepTin);
        };
        $project->delete();
        return redirect()->route('getPost')->with('success', 'Bạn đã xóa thành công!');
    }
    public function searchPost(Request $request)
    {
        $search = $request->input('search');
        
        $projects = Project::where('status', 'Đã được duyệt')->orderBy('created_at', 'desc')->get();
        if ($search) {
            $user = Auth::user();
            $id_user =$user->id;
            $results = Project::where(function($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                      ->orWhere('implementer', 'LIKE', '%' . $search . '%')
                      ->orWhere('created_at', 'LIKE', '%' . $search . '%');
            })
            ->where('status', 'Đã được duyệt')
            ->where('id_user', $id_user)
            ->orderBy('created_at', 'desc')
            ->get();
        } else {
            $results = null;
        }
        return view('posts.list-post', compact('projects', 'results', 'search'));
    }
    public function getApproval(){
        $user = Auth::user();
        $id_user =$user->id;
        $projects = Project::where('id_user', $id_user)
        ->where('status', '!=', 'Đã được duyệt')
        ->orderBy('created_at', 'desc')
        ->get();
        return view('approval.list-approval',compact('projects'));
    }
    public function getApprovalPost(String $id)
    {
        $user = Auth::user();
        $id_user =$user->id;
        $project = Project::where('id', $id)->first();
        $notifications = Notification::where('id_project', $id)->where('id_user', $id_user)->first();
        return view('approval.edit-approval', compact('notifications', 'project'));
    }
    public function deletetApproval(string $id)
    {
        $project = Project::find($id);
        $duongDanThuMuc = public_path('/theme/image/project');
        $tenTepTin = $project->image;
        if ($tenTepTin && File::exists($duongDanThuMuc . '/' . $tenTepTin)) {
            unlink($duongDanThuMuc . '/' . $tenTepTin);
        };
        $project->delete();
        return redirect()->route('getApproval')->with('success', 'Bạn đã xóa thành công!');
    }
    public function deleteNotification($id)
    {
        $notification = Notification::find($id);
        $notification->delete();
        return redirect()->back()->with('success', 'Đã xóa thông báo thành công');
    }
    public function getApproveViewList()
    {
        $user = Auth::user();
        $id_user =$user->id;
        $requestlist = Requesttoview::where('id_user',$id_user)->orderBy('created_at', 'desc')->get();
        return view('approval-view.approval-view-list', compact('requestlist'));
    }
    public function deleteApprovalView(string $id)
    {
        $requestView = Requesttoview::find($id);
        if (!$requestView) {
            return redirect()->route('getApproveViewList')->with('error', 'Không tìm thấy yêu cầu xem.');
        }
        $name = $requestView->user->name;
        $id_project = $requestView->id_project;
        $requestView->delete();
        $notification = Notification::where('id_project', $id_project)
            ->where('content', 'LIKE', '%' . $name . '%')
            ->where('type', 'Duyệt xem')
            ->first();
        if ($notification) {
            $notification->delete();
        }
        return redirect()->route('getApproveViewList')->with('success', 'Bạn đã xóa thành công!');
    }
}
