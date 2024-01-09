<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendApproveMail;
use App\Models\Requesttoview;
use App\Mail\SendCancelMail;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Typeproject;
use App\Models\Project;
use App\Models\User;

class AdminController extends Controller
{
    public function getAdminPost()
    {
        $projects = Project::where('status', 'Đã được duyệt')->orderBy('created_at', 'desc')->get();
        return view('admin.posts.list-post',compact('projects'));
    }
    public function getAdminPostAdd()
    {
        $typeprojects = Typeproject::All();
        return view('admin.posts.add-post', compact('typeprojects'));
    }
    public function postAdminPostAdd(Request $request)
    {   
        $name = '';
        $this->validate($request, [
            'image' => 'required|mimes:jpg,png,gif,jpeg|max: 2048',
            'name' => 'required|unique:projects,name',
            'summary' => 'required',
            'implementer' => 'required',
            'report_link' => 'nullable|url',
            'product_link' => 'nullable|url',
            'application_link' => 'nullable|url',
        ], [
            'image.mimes' => 'Chỉ chấp nhận file hình ảnh',
            'image.max' => 'Chỉ chấp nhận hình ảnh dưới 2Mb',
            'image.required' =>'Bạn chưa chọn hình ảnh',
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
        $projects->status = 'Đã được duyệt';
        $projects->save();

        $id_project = $projects->id;
        return redirect()->route('admin.getAdminPost')->with('success', 'Bạn đã đăng thành công!'); 
    }
    public function getAdminPostEdit(string $id)
    {
        $project = Project::where('id', $id)->first();
        $typeprojects = Typeproject::All();
        return view('admin.posts.edit-post', compact('typeprojects','project'));
    }
    public function postAdminPostEdit(Request $request, string $id)
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
        return redirect()->route('admin.getAdminPost')->with('success', 'Bạn đã sửa thành công!');
    }
    public function deletetAdminPost(string $id)
    {
        $project = Project::find($id);
        $duongDanThuMuc = public_path('/theme/image/project');
        $tenTepTin = $project->image;
        if ($tenTepTin && File::exists($duongDanThuMuc . '/' . $tenTepTin)) {
            unlink($duongDanThuMuc . '/' . $tenTepTin);
        };
        $project->delete();
        return redirect()->route('admin.getAdminPost')->with('success', 'Bạn đã xóa thành công!');
    }
    public function searchAdminPost(Request $request)
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
            ->orderBy('created_at', 'desc')
            ->get();
        } else {
            $results = null;
        }
        return view('admin.posts.list-post', compact('projects', 'results', 'search'));
    }
    public function getMyprofileAdmin()
    {
        $user = Auth::user();
        return view('admin.profile.profile', compact('user'));
    }
    public function postEditprofileAdmin(Request $request, $id)
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
        return redirect()->route('admin.getMyprofileAdmin')->with('success1', 'Cập nhật thông tin thành công!');
    }
    public function changepasswordAdmin(Request $request, $id)
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
    public function getCategoryList(){
        $typeprojects=Typeproject::orderBy('created_at', 'desc')->get();
        return view('admin.categories.category',compact('typeprojects'));
    }
    public function getCategoryAdd()
    {
        return view('admin.categories.add-category');
    }
    public function postCategoryAdd(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|unique:typeprojects,name',
        ],[
            'name.required'=>'Bạn chưa nhập tên loại danh mục',
            'name.unique'=>'Danh mục đã tồn tại',
        ]);
        $typeproject=new Typeproject();
        $typeproject->name=$request->name;
        $typeproject->save();
        return redirect()->route('admin.getCategoryList')->with('success','Bạn đã thêm thành công!');  
    }
    public function getCategoryEdit(string $id)
    {
        $typeproject=Typeproject::where('id',$id)->get();
        return view('admin.categories.edit-category',array('typeproject'=>$typeproject));
    }
    public function postCategoryEdit(Request $request,string $id)
    {
        $this->validate($request,[
            'name'=>'required',
        ],[
            'name.required'=>'Bạn chưa nhập tên loại danh mục',
        ]);
        $typeproject=Typeproject::find($id);
        $typeproject->name=$request->name;
        $typeproject->save();
        return redirect()->route('admin.getCategoryList')->with('success','Bạn đã sửa thành công!');  
    }
    public function deletetCategory(string $id)
    {
        $typeproject = Typeproject::find($id);
        $typeproject->delete();
        return redirect()->route('admin.getCategoryList')->with('success','Bạn đã xóa thành công!');
    }
    public function getUserList()
    {
        $users=User::where('level','!=','1')->orderBy('created_at', 'desc')->get();
        return view('admin.users.list-user',compact('users'));
    }
    public function getAddUser()
    {
        return view('admin.users.add-user');
    }
    public function postAddUser(Request $req)
    {
        $this->validate(
            $req,
            [
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|max:20',
                'name' => 'required',
                're-password' => 'required|same:password',
                'phone' => 'required|numeric|min:10'
            ],
            [
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Không đúng định dạng email',
                'email.unique' => 'Email đã có người sử  dụng',
                'password.required' => 'Vui lòng nhập mật khẩu',
                're-password.same' => 'Mật khẩu không giống nhau',
                'password.min' => 'Mật khẩu ít nhất 6 ký tự',
                'password.max' => 'Mật khẩu nhỏ hơn 20 ký tự',
                'phone.required' => 'Số điện thoại ít nhất 10 ký tự',
                'phone.numeric' => 'Số điện thoại phải là kiểu số',
                'phone.min' => 'Số điện thoại ít nhất 10 kí tự',
                'name' => 'Chưa nhập họ tên',
            ]
        );

        $user = new User();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->phone = $req->phone;
        $user->image = "daidien.jpg";
        $user->level = 3; 
        $user->save();
        return redirect()->route('admin.getUserList')->with('success', 'Tạo tài khoản thành công');
    }
    public function getUser(string $id)
    {
        $user=User::where('id',$id)->get();
        $post=Project::where('id_user',$id)->orderBy('created_at', 'desc')->get();
        return view('admin.users.profile-user',array('user'=>$user),compact('post'));
    }
    public function deletetUser(string $id)
    {
        $users = User::find($id);
        $duongDanThuMuc = public_path('/theme/image/users');
        $tenTepTin = $users->image;
        if ($tenTepTin && File::exists($duongDanThuMuc . '/' . $tenTepTin)) {
            unlink($duongDanThuMuc . '/' . $tenTepTin);
        };
        $users->delete();
        return redirect()->route('admin.getUserList')->with('success','Bạn đã xóa thành công!');
    }
    public function searchAdminUser(Request $request)
    {
        $search = $request->input('search');
        
        $users = User::where('level','!=','1')->orderBy('created_at', 'desc')->get();
        if ($search) {
            $user = Auth::user();
            $id_user =$user->id;
            $results = User::where(function($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                      ->orWhere('email', 'LIKE', '%' . $search . '%')
                      ->orWhere('phone', 'LIKE', '%' . $search . '%');
            })
            ->where('level', '!=', '1')
            ->orderBy('created_at', 'desc')
            ->get();
        } else {
            $results = null;
        }
        return view('admin.users.list-user', compact('users', 'results', 'search'));
    }
    public function getApproveProjectList()
    {
        $projects = Project::where('status', 'Đang chờ xét duyệt')->orderBy('created_at', 'desc')->get();
        return view('admin.approve.approve-project-list', compact('projects'));
    }
    public function getApproveProject(string $id)
    {
        $project = Project::where('id', $id)->first();
        return view('admin.approve.approve-project',compact('project'));
    }
    public function postApproveOrCancelProject(Request $request, string $id)
    {
        $projects = Project::find($id);
        $projects->note = $request->note;
        $id_user = $projects->id_user;
        if ($request->action == 'approve') {
            $this->handleApproveProject($projects, $request,$id_user);
        } elseif ($request->action == 'cancel') {
            $this->handleCancelProject($projects, $request,$id_user);
        }
        return redirect()->route('admin.getApproveProjectList')->with('success', 'Bạn đã gửi thành công!');
    }
    private function handleApproveProject($project, $request,$id_user)
    {
        if ($project->report_link != '' && $request->new_report_link == '') {
            $this->validate($request, [
                'new_report_link' => 'required|url',
            ], [
                'new_report_link.required' => 'Bạn chưa nhập đường link mới dẫn đến báo cáo',
                'new_report_link.url' => 'Định dạng không hợp lệ cho đường link mới dẫn đến báo cáo',
            ]);
        } else {
            $project->report_link = $request->new_report_link;
        }
        if ($project->product_link != '' && $request->new_product_link == '') {
            $this->validate($request, [
                'new_product_link' => 'required|url',
            ], [
                'new_product_link.required' => 'Bạn chưa nhập đường link mới dẫn đến sản phẩm',
                'new_product_link.url' => 'Định dạng không hợp lệ cho đường link mới dẫn đến sản phẩm',
            ]);
        } else {
            $project->product_link = $request->new_product_link;
        }
        if ($project->application_link != '' && $request->new_application_link == '') {
            $this->validate($request, [
                'new_application_link' => 'required|url',
            ], [
                'new_application_link.required' => 'Bạn chưa nhập đường link mới dẫn đến ứng dụng',
                'new_application_link.url' => 'Định dạng không hợp lệ cho đường link mới dẫn đến ứng dụng',
            ]);
        } else {
            $project->application_link = $request->new_application_link;
        }
        $project->status = 'Đã được duyệt';
        $project->save();
        $this->sendNotification($id_user, $project->id, 'Đề án của bạn đã được duyệt', 'Đã được duyệt');
    }
    private function handleCancelProject($project, $request,$id_user)
    {
        $project->status = 'Đã bị hủy';
        $project->save();
        $this->sendNotification($id_user, $project->id, 'Đề án của bạn đã bị hủy', 'Đã bị hủy');
    }
    private function sendNotification($id_user, $id_project, $content, $type)
    {
        $notification = new Notification();
        $notification->id_user = $id_user;
        $notification->id_project = $id_project;
        $notification->content = $content;
        $notification->type = $type;
        $notification->save();
    }
    public function getApproveViewList()
    {
        $requestlist = Requesttoview::orderBy('created_at', 'desc')->get();
        return view('admin.approve-view.approve-view-list', compact('requestlist'));
    }
    public function getApproveView(string $id)
    {
        $requests = Requesttoview::where('id', $id)->first();
        return view('admin.approve-view.approve-view', compact('requests'));
    }
    public function postApproveOrCancelView(Request $request, string $id)
    {
        $requestView = Requesttoview::find($id);
        $username = $requestView->User->name;
        $notification = "";
        if ($request->action == 'approve') {
            $this->handleApproveView($id);
            $notification = "Bạn đã chấp nhận yêu cầu của ".$username;
        } elseif ($request->action == 'cancel') {
            $this->handleCancelView($id);
            $notification = "Bạn đẵ từ chối yêu cầu của ".$username;
        }
        return redirect()->route('admin.getApproveViewList')->with('success', $notification);
    }
    private function handleApproveView($id)
    {
        $requestView = Requesttoview::find($id);
        $requestView->status = "Đã được duyệt";
        $sendApproveData = [
            'name' => $requestView->User->name,
            'email' =>  $requestView->email,
            'link' => $requestView->link,
            'content' => "Yêu cầu xem ".$requestView->type." của bạn đã được chấp nhận",
        ];
        Mail::to($requestView->email)->send(new SendApproveMail($sendApproveData));
        $requestView->save();
    }
    private function handleCancelView($id)
    {
        $requestView = Requesttoview::find($id);
        $requestView->status = "Đã bị hủy";
        $sendCancelData = [
            'name' => $requestView->User->name,
            'email' =>  $requestView->email,
            'content' => "Yêu cầu xem ".$requestView->type." của bạn không được chấp nhận",
        ];
        Mail::to($requestView->email)->send(new SendCancelMail($sendCancelData));
        $requestView->save();
    }
    public function deletetApproveOrCancelView(string $id)
    {
        $requestView = Requesttoview::find($id);
        $requestView->delete();
        return redirect()->route('admin.getApproveViewList')->with('success','Bạn đã xóa thành công!');
    }
}
