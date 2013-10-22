<?php
class Core_Const {
	public static $upload_ext = array (
			'jpg',
			'png',
			'gif',
			'bmp',
			'doc',
			'docx',
			'xls',
			'xlsx',
			'pdf',
			'zip',
			'rar',
			'gzip' 
	);
	public static $upload_image_ext = array (
			'jpeg',
			'jpg',
			'png',
			'gif',
			'bmp' 
	);
	public static $db_images = array (
			'id',
			'filename',
			'folder_id',
			'path_thumb',
			'path',
			'size',
			'create_time',
			'create_user',
			'deleted',
			'width',
			'height',
			'position' 
	);
	public static $langs = array (
			'vi',
			'en' 
	);
	public static $messages = array (
			'ERROR' => 'Có lỗi xảy ra, vui lòng thử lại sau',
			'LINK_ERROR' => 'Liên kết không hợp lệ',
			'VERIFY_SUCCESS' => 'Bạn đã xác nhận đăng ký tài khoản thành công!',
			'END_SESSION' => 'Vui lòng đăng nhập lại',
			'VERIFY_INVALID' => 'Mã xác nhận không hợp lệ!',
			'LINK_ERROR' => 'Liên kết không hợp lệ!',
			'INVALID_GIANHANG' => 'Gian hàng không tồn tại!',
			'EMAIL_NOT_EXIST' => 'Email %s không tồn tại trong hệ thống',
			'REQUEST_RESET_PASS_SUCCESS' => 'Bạn đã gửi yêu cầu cấp lại mật khẩu thành công, vui lòng kiểm tra email %s để lấy link cập nhật mật khẩu',
			'LOGIN_FAILED' => 'Đăng nhập không thành công, vui lòng kiểm tra lại username và password!',
			'LIMIT_REGISTRATION' => 'Vượt quá số lần đăng ký cho phép!',
			'LIMIT_PERMISSION' => 'Bạn không có quyền thực hiện thao tác này, mọi thắc mắc vui lòng liên hệ admin@jobbid.vn',
			'LIMIT_POST_JOB' => 'Vượt quá số lần đăng công việc cho phép!',
			'LIMIT_EDIT_JOB' => 'Vượt quá số lần cập nhật công việc cho phép!',
			LIMIT_RESET_PASSWORD => 'Vượt quá số lần gửi yêu cầu reset mật khẩu cho phép!',
			'LIMIT_REFESH_JOB' => 'Vượt quá số lần up tin cho phép!',
			'LOGIN_REQUIRED' => 'Bạn cần đăng nhập để thực hiện chức năng này!',
			'ACTIVE_REQUIRED' => 'Bạn cần xác nhận tài khoản để thực hiện chức năng này!',
			'CHANGE_PROFILE_SUCCESS' => 'Cập nhật thông tin cá nhân thành công!',
			'LOCK_ACTION' => 'Thao tác của bạn đã bị chặn từ hệ thống jobbid.vn, mọi thắc mắc vui lòng liên hệ admin@jobbid.vn.',
			'PROHIBITION_WORDS' => 'Nội dung không hợp lệ, mọi thắc mắc vui lòng liên hệ admin@jobbid.vn.',
			'INVALID_USERNAME' => 'Tài khoản này không tồn tại' 
	)
	;
	public static $success_messages = array (
			'CHANGE_PASSWORD' => 'Thay đổi mật khẩu thành công!',
			'UPDATE' => 'Cập nhật thành công!' 
	);
	public static $error_messages = array (
			'CHANGE_PASSWORD' => 'Thay đổi mật khẩu không thành công!',
			'VALIDATE_FORM' => 'Form nhập chưa hợp lệ',
			'LIMIT_SLIDE' => 'Bạn không thể thêm quá %s hình ảnh!' 
	);
	public static $captcha_type = array (
			'register',
			'reset_pass' 
	);
}
?>