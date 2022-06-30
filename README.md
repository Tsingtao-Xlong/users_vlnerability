# 发布

### 测试发布
####复制composer包中的文件到项目中去（config、migrations、Models）
>php artisan vendor:publish --provider="Xlong\UsersVlnerability\UsersVlnerabilityServiceProvider"

> @post  lee.z.com/api/rsa/create
> user_id=1111

> @post lee.z.com/api/rsa/check
>
> rsa_code = emZiAl80aRNz+UaZrWzLcxZ9oOIG0tEiT7SEqWRgzguTcHPhFrLhVaC2xVxZlwN8HVMlK9jd/xLhdps2BqWJNgmE1y67Ltb2P4S1e7T74YkZ9cCONqCld0XsAcPCh1RNoMniBuvk+5eN4T4Wy5WI+wA0TcK9fQ9R8RZUvL68sxM=
> 
> user_id = 9448840

# 🔧 版本要求
PHP >= 7.0
Laravel >= 8

确保安装Redis

🛠 安装
建议通过Composer来安装
>composer require ivone/n2search