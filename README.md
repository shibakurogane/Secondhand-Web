# Secondhand-Web
## Cài đặt xampp.
## Cài đặt Composer

tải file Composer-Setup.exe tại đây. https://getcomposer.org/composer-2.phar
Khởi động file Composer-Setup.exe  
Lựa chọn thư mục cài đặt, đặt chung với XAMPP.  

![ảnh](https://user-images.githubusercontent.com/64851127/133403352-eb4a0853-3408-4d00-83a1-6ae92f9192de.png)

Lựa chọn đường dẫn đến phiên bản PHP muốn sử dụng (Ở đây dùng PHP 7.18 trên XAMPP).  

![ảnh](https://user-images.githubusercontent.com/64851127/133403386-623029c4-1ebd-49e6-949f-b39b189eef75.png)

Nhấn Install để cài đặt.  
Sau khi Composer Cài đặt xong nhấn Next và Install để kết thúc.  
-Fork project về repo cá nhân  
-Clone project về xampp/htdocs  
-Add remote repository vào htdocs `git remote add Web https://github.com/Vainres/Secondhand-Web.git`  

# WORKFLOW
## Khi bắt đầu mỗi lần làm
-Chuyển về nhánh chính main  
-Pull code mới nhất từ git `git pull Web main`  
-Tạo và chuyển branch mới  
-Code  

## Sau khi xong
-Pull code mới nhất từ git `git pull Web main`  
-Fix conflict nếu có  
-Push code lên repository folk về lúc đầu  
-Tạo pull request từ đó  


-Xin chao