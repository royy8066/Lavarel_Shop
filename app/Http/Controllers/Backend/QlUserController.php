<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Login;
use Illuminate\Http\Request;

class QlUserController extends Controller
{
    public function qltk()
    {
        $users = Login::paginate(10);
        return view('backend.taikhoan.qltk', compact('users'));
    }

    public function edit($id)
    {
        $user = Login::findOrFail($id);
        return view('backend.taikhoan.edituser', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = Login::findOrFail($id);
        $user->update($request->only(['fullname', 'email']));
        return redirect()->route('backend.taikhoan.qltk')->with('success', 'Cập nhật tài khoản thành công!');
    }

    public function destroy($id)
    {
        $user = Login::findOrFail($id);
        $user->delete();
        return redirect()->route('backend.taikhoan.qltk')->with('success', 'Xóa tài khoản thành công!');
    }
}
