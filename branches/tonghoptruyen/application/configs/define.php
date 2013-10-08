<?php
define ( 'APP_CONFIG', 'REGISTRY_APP_CONFIG' );
define ( 'DEFAULT_LANG', 'vi' );
define ( 'SITE_TITLE', 'Sàn Giao Dịch Việc Làm Thêm' );
define ( 'SITE_DESCRIPTION', 'Jobbid.vn là sàn việc làm để bạn có thể đăng thông tin tuyển dụng việc làm thêm, qua đó tìm được ứng viên thích hợp để thực hiện công việc của bạn. Các bạn có thể tìm kiếm được những công việc làm thêm hoặc các dự án nhỏ phù hợp với khả năng của bạn.' );
define ( 'SITE_KEYWORDS', 'jobbid.vn,tim viec part time, tìm việc part time,sàn việc làm,viec ban thoi gian,viec lam tu do,san viec lam,viec ban thoi gian,du an, cong viec,tim viec ban thoi gian,viec lam tai nha,tim viec lam them, lam them, viec part time,cong viec ban thoi gian,tim viec,viec lam online, viec lam ban thoi gian, tìm việc làm thêm,làm thêm,việc part time,công việc tại nhà,công việc bán thời gian,dự án,công việc,tìm việc,việc làm online,việc làm bán thời gian,việc làm tại nhà, làm thêm online, làm thêm cho sinh viên, làm thêm trên mạng,việc bán thời gian,việc làm tự do' );
define ( 'TIME_CREATE_NEW_VISITOR', 30 ); // gioi han thoi gian idle cua client de tao 1 luot truy cap moi
define ( 'SAFE_MODE', false );
define ( 'SITE_NAME', 'Sàn Giao Dịch Việc Làm Thêm' );
define ( 'MAX_LOOP', 100 );
define ( 'MSG_ERROR', 'MSG_ERROR' );
define ( 'MSG_OK', 'MSG_OK' );
define ( 'MSG_MIN_LENGTH', 'MSG_MIN_LENGTH' );
define ( 'MSG_NOT_EXIST', 'MSG_NOT_EXIST' );
define ( 'MSG_EXIST', 'MSG_EXIST' );
define ( 'DEFAULT_DISPLAY_LENGTH', 10 );
define ( 'LOGIN_PAGE_BACK', 'back/auth/login' );
define ( 'LOGIN_PAGE', 'front/tai-khoan/dang-nhap' );
define ( 'LOGIN_PAGE_POPUP', 'back/auth/login-popup' );
define ( 'DEFAULT_BACK_PAGE', 'back/user' );
define ( 'MAX_LOGIN_FAILED', 3 );
define ( 'MAX_RESETPASS_REQUEST', 3 );
define ( 'RESETPASS_KEY_EXPIRE', 3 );
define ( 'PUBLIC_DIR', APPLICATION_PATH . "/.." );
define ( 'PATH_UPLOAD_IMAGE', '/upload/images' );
define ( 'PATH_IMAGE_THUMN', '/upload/images/thumn' );
define ( 'PATH_IMAGE_RESIZE', '/upload/images/resize' );
define ( 'PATH_UPLOAD_LOGO', '/upload/images/logo' );
define ( 'PATH_UPLOAD_SLIDE', '/upload/images/slide' );
define ( 'PATH_UPLOAD_PRODUCT_IMAGE', '/upload/images/product_image' );
define ( 'PATH_UPLOAD_FILE', '/upload/files' );
define ( 'PATH_CAPTCHA_IMAGES', PUBLIC_DIR . '/captcha/images' );
define ( 'PATH_CAPTCHA_FONT', PUBLIC_DIR . '/captcha/font/verdana.ttf' );
define ( 'MIN_FILE_SIZE_UPLOAD', '1kB' );
define ( 'MAX_FILE_SIZE_UPLOAD', '4MB' );
define ( 'URL_UPLOAD_MAX_FILE_SIZE', 4000000);
define ( 'LIMIT_SLIDE', 5 );
define ( 'BUFFER_ELEMENT_IN_SESSION', 100 );
define ( 'DEFAULT_IMAGE_RESIZE_QUALITY', 80 );
define ( 'MIN_CONTENT_LENGTH', 30 );
define ( 'MAX_CONTENT_LENGTH', 6000 );

// Session variables
define ( 'SESSION_TIME_VARIABLE_SHORT', 60 * 2 ); // 2 minutes
define ( 'SESSION_TIME_VARIABLE_NORMAL', 60 * 5 ); // 5 minutes
define ( 'SESSION_TIME_VARIABLE_LONG', 60 * 30 ); // 30 minutes
                                             
// Config email sender
define ( 'SENDER_EMAIL', 'no-reply@jobbid.vn' );
define ( 'SENDER_EMAIL_PASSWORD', '74198788' );
define ( 'SENDER_EMAIL_SMTP', 'mail.jobbid.vn' );
define ( 'SENDER_EMAIL_PORT', '465' );
define ( 'SENDER_EMAIL_SEC', 'jobbid.vn@gmail.com' );
define ( 'SENDER_EMAIL_PASSWORD_SEC', '74198788' );
define ( 'SENDER_EMAIL_SMTP_SEC', 'smtp.gmail.com' );
define ( 'SENDER_EMAIL_PORT_SEC', '465' );
define ( 'SENDER_EMAIL_FROM', 'JobBid.vn' );
define ( 'REPLY_TO_EMAIL', 'no-reply@jobbid.vn' );
define ( 'DEV_EMAIL', 'nclong87@gmail.com' );
define ( 'EMAIL_LOG', 'log@jobbid.vn' );

// Config file manager
define ( 'PAGING_IMAGE_PER_PAGE', 10 );

// Config folder images
define ( 'FOLDER_IMAGE_SLIDER', 2 );
define ( 'FOLDER_IMAGE_RESTAURANT', 1 );

// Front
define ( 'FRONT_PAGE_SIZE', 6 );
define ( 'INT_PAGE_SUPPORT', 3 );
define ( 'SEARCH_PAGE_SIZE', 20 );

// format time
define ( 'TIME_FORMAT_SQL', 'Y-MM-dd HH:mm:ss' );
define ( 'TIME_FORMAT_FRIENDLY', 'dd/MM/Y HH:mm:ss' );

// role type
define ( 'ROLE_ADMIN', 1 );
define ( 'ROLE_USER', 2 );
                                   
// email subjects
define ( 'EMAIL_SUBJECT_VERIFY_ACCOUNT', '[jobbid.vn] Email kích hoạt tài khoản.' );
define ( 'EMAIL_SUBJECT_VERIFY_JOB', '[jobbid.vn] Email xác nhận tin tuyển dụng.' );
define ( 'EMAIL_SUBJECT_RESET_PASSWORD', '[jobbid.vn] Email xác nhận thay đổi mật khẩu đăng nhập.' );

// Email
define ( 'EMAIL_WEEKLY', 'EMAIL_WEEKLY' );

// Reference
define ( 'REF_EMAIL_WEEKLY', 'REF_EMAIL_WEEKLY' );
define ( 'REF_RECRUIT_VIEW', 'REF_RECRUIT_VIEW' );

define ( 'EOL', "\r\n" );

// Log type
define ( 'LOG_JOBBID', 'LOG' );
define ( 'LOG_ERROR', 'ERROR' );
define ( 'LOG_EMAIL', 'EMAIL' );

define ( 'QUERY_DB_RETURN_MULTI', 1 );
define ( 'QUERY_DB_RETURN_ONE', 2 );
define ( 'QUERY_DB_RETURN_NO', 3 );

//image
define('IMG_THUMB_WIDTH', 150);
define('IMG_THUMB_HEIGHT', 200);