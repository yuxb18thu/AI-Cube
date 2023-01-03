# AI-Cube

## 系统配置要求

- 操作系统:ubuntu18
- CPU架构:x86
- 最小资源配置:8核16G

### 安装前检查

1. 服务器5000端口空闲
2. 用于配置SSL证书的解析到公网IP的域名。
3. 服务器语言环境配置为"en_US.UTF-8"

### 环境配置

python：3.6

#### flask安装

pip install flask

#### DeepCubeA 代码运行环境配置 

下载：Docker Community Edition (CE): https://www.docker.com/community-edition nvidia-docker: https://github.com/NVIDIA/nvidia-docker/ 

系统依赖库安装： apt-get update && apt-get install -y --no-install-recommends \ "build-essential=12.4ubuntu1" "libboost-all-dev=1.65.1.0ubuntu1" \ "libboost-dev=1.65.1.0ubuntu1" && rm -rf /var/lib/apt/lists/* 

开发平台(安装了 conda): conda install --yes python==2.7.5 tensorflow-gpu==1.8.0 && conda clean --yes --all 

平台依赖库： pip install --upgrade dm-sonnet==1.10 matplotlib==2.2.3

### 运行与使用

1. 从https://codeocean.com/capsule/5723040/tree/v1下载训练过的模型，放入正确的文件路径(/code/savedModels/…)
2. 在/interface/server.py中更改ip，并运行python server.py，将网站部署到当前设备。
3. 打开网址为127.0.0.1:5000的网页，端口可以在/interface/server.py底部编辑。