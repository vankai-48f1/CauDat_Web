<?php
/**
 * Cấu hình cơ bản cho WordPress
 *
 * Trong quá trình cài đặt, file "wp-config.php" sẽ được tạo dựa trên nội dung 
 * mẫu của file này. Bạn không bắt buộc phải sử dụng giao diện web để cài đặt, 
 * chỉ cần lưu file này lại với tên "wp-config.php" và điền các thông tin cần thiết.
 *
 * File này chứa các thiết lập sau:
 *
 * * Thiết lập MySQL
 * * Các khóa bí mật
 * * Tiền tố cho các bảng database
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Thiết lập MySQL - Bạn có thể lấy các thông tin này từ host/server ** //
/** Tên database MySQL */
define( 'DB_NAME', 'CauDat_Web' );

/** Username của database */
define( 'DB_USER', 'root' );

/** Mật khẩu của database */
define( 'DB_PASSWORD', '' );

/** Hostname của database */
define( 'DB_HOST', 'localhost' );

/** Database charset sử dụng để tạo bảng database. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Kiểu database collate. Đừng thay đổi nếu không hiểu rõ. */
define('DB_COLLATE', '');

/**#@+
 * Khóa xác thực và salt.
 *
 * Thay đổi các giá trị dưới đây thành các khóa không trùng nhau!
 * Bạn có thể tạo ra các khóa này bằng công cụ
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Bạn có thể thay đổi chúng bất cứ lúc nào để vô hiệu hóa tất cả
 * các cookie hiện có. Điều này sẽ buộc tất cả người dùng phải đăng nhập lại.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'r=R_EK/HB^ZP!C{wOL&-d&E<,9VNd?F3!uFiVwGO|`ZQmPX.<?$z5k2bjuCU4~O+' );
define( 'SECURE_AUTH_KEY',  '?TJI[*p9TOJUW#h9O_:3j6c;mWHsy|avRcb-*h3$7Z7lQ[Gm*m7$W`QGt!(=B~5-' );
define( 'LOGGED_IN_KEY',    '8e7G4wQ1/Lx(,M`ec:tENUBsJxS3_87RP.q+7imf9R&{Ui%3)G2_qF2+W|pJrMPH' );
define( 'NONCE_KEY',        'cgrF8aV%^0Ve_W6>#%W)vz]S`+{c?jPv:@l b`N#}eyzK~a$7E!!!AVxxA$2aU0?' );
define( 'AUTH_SALT',        'T4SqxGJlh=j2bHs{I7o8mr&%!)RPcCapYPkxeCb$wM_Q3p,*94ad-89Fvi!m4Gvp' );
define( 'SECURE_AUTH_SALT', 'Cf4&A_NFCpyH.3>Hu&Z-M-AaU--Q:w!DL k^a.Er5$A.4ngI`h9h2JI9VF~!*;xn' );
define( 'LOGGED_IN_SALT',   '[:zAKULPP.>7@7^|Vzn;!f.-:L!Sw%.!Z*#)95cn!SkZwOzsr^& :p=TP/M2=Emk' );
define( 'NONCE_SALT',       '5bMA.8V4lXq[D_O3,R U<jIiQ1)!;+nA[nO{XK>Hb#u91jDnmF7z}RL:Qqy;luC*' );

/**#@-*/

/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix = 'wp_caudat';

/**
 * Dành cho developer: Chế độ debug.
 *
 * Thay đổi hằng số này thành true sẽ làm hiện lên các thông báo trong quá trình phát triển.
 * Chúng tôi khuyến cáo các developer sử dụng WP_DEBUG trong quá trình phát triển plugin và theme.
 *
 * Để có thông tin về các hằng số khác có thể sử dụng khi debug, hãy xem tại Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/** Ngôn ngữ */
// define ('WPLANG', 'en_US');

/* Đó là tất cả thiết lập, ngưng sửa từ phần này trở xuống. Chúc bạn viết blog vui vẻ. */

/** Đường dẫn tuyệt đối đến thư mục cài đặt WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Thiết lập biến và include file. */
require_once(ABSPATH . 'wp-settings.php');
