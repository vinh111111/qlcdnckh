<style>
    a.send-approve-link {
        display: inline-block;
        padding: 10px 20px;
        background-color: #3498db;
        color: #ffffff;
        text-decoration: none;
        text-align: center;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }
    a.send-approve-link:hover {
        background-color: #2980b9;
        font-weight: bold;
    }
</style>
<p>Họ và tên: {{ $sendApproveData['name'] }}</p>
<p>Email: {{ $sendApproveData['email'] }}</p>
<p>Nội dung: {{ $sendApproveData['content'] }}</p>
<a href="{{ $sendApproveData['link'] }}" style="display: inline-block; padding: 10px 20px; background-color: #3498db; color: #ffffff; text-decoration: none; text-align: center; border-radius: 5px; transition: background-color 0.3s ease;" target="_blank">Đường dẩn</a>