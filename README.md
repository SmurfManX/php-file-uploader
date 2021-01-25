# Simple  php web for upload large files to the server by chunks

# Instalation:

```
cd /var/www/html/
git clone https://github.com/SmurfManX/php-file-uploader.git
cd php-file-uploader
download latest plupload from: (https://www.plupload.com/)
mv plupload-*.tar plupload 
```


# Folder structure:
```
/plupload
/uploads
index.php
upload.php
```
# NGINX config example:
```
server {
    root /var/www/html/php-file-uploader;
    index  index.php upload.php;
    server_name uploader.example.com;

location / {
        client_max_body_size 20000m;
        client_body_buffer_size 1000m;
        proxy_buffer_size 64k;
        proxy_buffers 2048 64k;
        proxy_max_temp_file_size 0;
        proxy_pass_request_headers on;
        proxy_set_header X-FILE $request_body_file;
        proxy_redirect off;
        proxy_set_body off;
        proxy_http_version 1.1;
        try_files $uri $uri/ /index.php?$args;

}

location ~ \.php$ {
        client_max_body_size 20000m;
        client_body_buffer_size 1000m;
        proxy_buffer_size 64k;
        proxy_buffers 2048 64k;
        proxy_max_temp_file_size 0;
        include snippets/fastcgi-php.conf;
        proxy_pass_request_headers on;
        proxy_set_header X-FILE $request_body_file;
        proxy_redirect off;
        proxy_set_body off;
        proxy_http_version 1.1;
        fastcgi_pass 127.0.0.1:9000;
    }
}
```
# Uploader
![plot](./uploader.png)

# Inspect / Network
![plot](./inspect.png)

<a href="https://www.buymeacoffee.com/smurfmanx" target="_blank"><img src="https://cdn.buymeacoffee.com/buttons/default-orange.png" alt="Buy Me A Coffee" height="41" width="174"></a>

