Hướng dẫn Cài Đặt và Sử Dụng Website

Sinh viên thực hiện: 
	Nguyễn Thị Diễm Quỳnh
	Nguyễn Thị Thu Vân
	Thái Văn Trung
	Trần Đức Việt
	Trương Trần Tâm
	Lê Thị Kim ĐÀO
NHÓM: 05

1. **Yêu Cầu Hệ Thống:**
    - PHP (phiên bản khuyến nghị: 8.0.28)
    - MySQL
    - XAMPP:
        + Cài đặt và lưu vào ổ đĩa C.
        + Khởi chạy Apache, MySQL (nếu trường hợp chúng không hoạt động thì chỉnh sửa ở Config).
    - Visual Studio Code.

2. **Cài Đặt:**
    - Giải nén file đuôi rar này vào ổ đĩa C:\xampp\htdocs (minh hoạ).
        => Kết quả: C:\xampp\htdocs\BaiTapLon_WebsiteSieuThiDienMay (minh họa).
    - Mở cở sở dữ liệu MySQL bằng cách:
        + Vào trình duyệt (khuyên dùng: Microsoft Edge).
        + Sau đó ta nhập http://localhost:8088/phpmyadmin/ để mở giao diện MySQL. 
        (Lưu ý: http://localhost:8088: Đây là URL của máy chủ web cục bộ (localhost), và 8088 là số cổng (port) được sử dụng. Port 8088 được chọn để lắng nghe các yêu cầu HTTP, bạn cũng có thể thay đổi port để phù hợp với cấu hình).
        + Import cơ sở dữ liệu từ tệp SQL có sẵn (`NHOM_5.sql`) vào hệ quản trị cơ sở dữ liệu MySQL.
    - Cấu hình kết nối cơ sở dữ liệu trong file `db/connect.php`.
    - Vào Visual Studio Code Cài đặt các Extensions phù hợp để sử dụng.

4. **Sử Dụng Website:**
    - Truy cập trang chủ bằng cách mở trình duyệt và nhập địa chỉ website vào thanh địa chỉ. 
        + http://localhost:3000/admin/admin-dashboard.php (minh họa).
    - Bạn có thể mở giao diện website tại IDE (Visual Studio Code)
        + Chọn vào file admin-dashboard.php (minh họa) và nhấn chuột phải, sau đó chọn PHP Server project (Lưu ý phải cài đặt các Extensions tương ứng để chạy).

    --Sử dụng giao diện Admin:--
        + Sử dụng email, password (admin) trong cơ sở dữ liệu để tiến hành đăng nhập. Sau khi đăng nhập xong sẽ chuyển đến giao diện chính của admin.
        + Giao diện chính của admin có các layout để người dùng tương tác.
            Layout thứ nhất: Màn hình chính ở hình 2.
            Layout thứ hai: Thêm sản phẩm.
            Layout thứ ba: Danh sách sản phẩm.
            Layout thứ tư: Quản lý khách hàng.
            Layout thứ năm: Quản lý đơn hàng.
            Người dùng admin chọn layout theo từng loại công việc của mình để bắt đầu tương tác.

    *Sử dụng giao diện Thêm sản phẩm:
        + Giao diện thêm sản phẩm có một form để người dùng nhập dữ kiện vào.
            Tên sản phẩm, ID danh mục, giá sản phẩm, chi tiết sản phẩm, tình trạng (Hoạt động, không hoạt động), Sản phẩm hot (Không, có), số lượng sản phẩm, tải hình ảnh sản phẩm lên.
            Sau khi đã thực hiện nhập dữ kiện đầy đủ từ các yêu cầu trên, người dùng thực hiện hành động nhấn vào button (thêm sản phẩm).
	    Mục bảo hành đã được đặt theo mã loại hàng hoá nên người dùng không cần nhập và thông tin bảo hành sẽ tự động cập nhật qua trang chitietsanpham.

    *Sử dụng giao diện Hiển thị sản phẩm:
        + Giao diện hiển thị danh sách sản phẩm có các mục như sau:
            STT, ID, Tên sản phẩm, danh mục, giá sản phẩm, chi tiết, tình trạng, sản phẩm hot, số lượng, hình ảnh, chỉnh sửa.
            Đối với mục chỉnh sửa: Người dùng có thể cập nhật lại các mục của sản phẩm, và xóa một sản phẩm bất kỳ mà mình muốn, khi xóa sẽ hiển thị một thông báo nhắc nhở người dùng có muốn xóa hay không.
    
    *Sử dụng giao diện quản lý khách hàng:
        + Giao diện quản lý khách hàng có nhiệm vụ lưu lịch sử mà khách hàng đã tiến hành giao dịch, dữ liệu khách hàng sẽ không mất khi chúng ta xóa đơn hàng, nói chung giao diện này người dùng có thể biết được lịch sử khách hàng đã tiến hành thanh toán đơn hàng.

    *Sử dụng giao diện quản lý đơn hàng:
        + Giao diện quản lý đơn hàng có nhiệm vụ là cập nhật những khách hàng đã thanh toán đơn hàng, có các mục như:
            STT, Tên khách hàng, số lượng, giá sản phẩm, tổng số tiền, ngày tháng, tình trạng đơn, hủy đơn, quản lý, chi tiết.
            Đối với mục quản lý có các chức năng: xóa, cập nhật.
            Xóa: Khi người dùng chọn thì hệ thống sẽ hiển thị một thông báo hỏi người dùng có muốn xóa hay không.
            Cập nhật: Người dùng sẽ cập nhật tình trạng đơn hàng (Duyệt, chưa duyệt), tình trạng hủy đơn (Có, không). Bằng cách chọn vào các check radio.
            Đối với mục chi tiết: Người dùng có thể xem rõ hơn thông tin của khách hàng.
            Tên sản phẩm, tổng tiền, tên khách hàng, ID khách hàng, địa chỉ, email, số điện thoại.

    --Sử dụng giao diện Khách hàng--
        + Sử dụng giao diện khách hàng (home.php): 
            Giao diện khách hàng (home.php) có các danh mục sản phẩm, tìm kiếm sản phẩm,giỏ hàng.
            Ngoài ra còn có các sản phẩm hot (Xu Hướng 2025).
            Khách hàng có thể tìm kiếm sản phẩm bằng cách nhập tên sản phẩm vào.
                Ví dụ: Nhập vào iPhone thì nó sẽ hiển thị ra các mục iPhone để bạn tùy chọn. Khi nhấn vào thì sẽ điều hướng đến chi tiết sản phẩm.
        
        + Sử dụng giao diện chi tiết sản phẩm (chitietsanpham.php):
            Khách hàng sẽ được xem ảnh sản phẩm, thông tin sản phẩm, giá sản phẩm, thời gian bảo hành của sản phẩm đó chọn số lượng sản phẩm và thêm sản phẩm vào giỏ hàng.
        
        + Sử dụng giao diện giỏ hàng (giohang.php):
            Sau khi thêm sản phẩm vào giỏ hàng, khách hàng có thể cập nhật số lượng sản phẩm. Xem tổng tiền sản phẩm, và xóa sản phẩm ra khỏi giỏ hàng.
            Tiến hành thanh toán đơn hàng.
                Lưu ý: Nếu giỏ hàng trốn thì khách hàng không thể tiến hành thanh toán đơn hàng.
        
        + Sử dụng giao diện thanh toán (thanhtoan.php):
            Sau khi khách hàng đã nhấn vào button "Tiến hành thanh toán" thì sẽ chuyển đến form điền thông tin khách hàng và tiếp tục lựa chọn loại thanh toán.
            Khách hàng điền thông tin xong thì nhấn "Xác nhận thanh toán" để đơn hàng được xử lý.

5. **Chú Ý:**
    - Đảm bảo các thư mục và tệp tin có quyền truy cập đúng.
    - Đối với môi trường phát triển, bật hiển thị lỗi để dễ dàng theo dõi và sửa lỗi.
    - Nếu xảy không mở được trang website thì cần kiểm tra XAMPP đã bật chưa.
