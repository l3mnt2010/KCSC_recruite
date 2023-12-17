bài này là LFI á:<


vào giao diện sẽ như này ![Alt text](image.png)

thì có 1 routes FLAG như kia mình có ấn qua thử nhưng không có gì 
vìa thấy url có parameter và page nên mình đoán nó là file includetion

thử với param 

                                        ?page=php://filter/convert.base64-encode/resource=pages/flag.php

![Alt text](image-1.png)
Lấy chuỗi ra decode base64 thì được flag:<