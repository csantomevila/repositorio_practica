
###1. Descargar e comprobar que unha imaxe está no teu equipo###

Descarga de imagenes 
sudo docker pull "Nombre_imagen"

comprobacion de imagenes 
docker images


###2. Crear un contenedor sen nome, queda arrincado?, cómo obtés o nome?

docker run -d "nombre_imagen" / se crea un nombre predefinido por docker pueden comprobarse con el resto de contenedores con 

docker ps -a





###3. Crea un contenedor coo nome 'u1', cómo accedes a el?

creacion de contenedor
docker run -d --name u1 ubuntu 

acceso al contenedor 
docker exec -it u1 /bin/bash






###4. Comproba a súa ip e fai ping a google.com

Comprobacion de ip 

christian@christian-VirtualBox:~$ docker inspect -f '{{range.NetworkSettings.Networks}}{{.IPAddress}}{{end}}' u1
172.17.0.3
christian@christian-VirtualBox:~$ 



CONexiones externas

se deben instalar los servicios de ping con un update y
apt install iputils-ping -y

Ping google.com




5. Crea un contenedor coo nome 'bono', pódes facer ping entre os contenedores?

Creacion contenedor Bono 

christian@christian-VirtualBox:~$ docker run -it --name bono ubuntu /bin/bash
root@7dbb0b54b7e3:/# 


Creacion de red intermediaria entre contenedores 

christian@christian-VirtualBox:~$ docker network create my_network
147590103ad1131146ab343cad1691ed0615c824c392364ecc2733d0626b390c
christian@christian-VirtualBox:~$ 


Conecta ambos contenedores en la misma red 

docker network connect my_network u1
docker network connect my_network bono

cOnexion entre contenedores 

root@45a725057486:/# ping bono
PING bono (172.18.0.3) 56(84) bytes of data.
64 bytes from bono.my_network (172.18.0.3): icmp_seq=1 ttl=64 time=0.214 ms
64 bytes from bono.my_network (172.18.0.3): icmp_seq=2 ttl=64 time=0.129 ms



7. Se pechas as terminales, qué pasa coo contenedor?

nada , siguen activos 
christian@christian-VirtualBox:~$ docker ps 
CONTAINER ID   IMAGE     COMMAND            CREATED          STATUS          PORTS     NAMES
7dbb0b54b7e3   ubuntu    "/bin/bash"        33 minutes ago   Up 3 minutes              bono
45a725057486   ubuntu    "/bin/bash"        47 minutes ago   Up 44 minutes             u1
10e39383bbd2   ubuntu    "sleep infinity"   48 minutes ago   Up 48 minutes             practical_margulis
christian@christian-VirtualBox:~$ 




8. Cánta memoria no disco duro ocupaches? usa docker para calculalo

docker sTATS 


CONTAINER ID   NAME                 CPU %     MEM USAGE / LIMIT     MEM %     NET I/O          BLOCK I/O         PIDS
7dbb0b54b7e3   bono                 0.00%     63.51MiB / 7.771GiB   0.80%     26.2MB / 404kB   24.4MB / 26.9MB   1
45a725057486   u1                   0.00%     44.84MiB / 7.771GiB   0.56%     26MB / 308kB     131kB / 26.9MB    2
10e39383bbd2   practical_margulis   0.00%     804KiB / 7.771GiB     0.01%     4.59kB / 0B      36.9kB / 0B       1


9. Cánta RAM ocupan os contenedores? Crea varios para calculalo

87kB / 0B      0B / 0B           1
7dbb0b54b7e3   bono                 0.00%     63.51MiB / 7.771GiB   0.80%     26.2MB / 404kB   24.4MB / 26.9MB   1
45a725057486   u1                   0.00%     44.84MiB / 7.771GiB   0.56%     26MB / 308kB     131kB / 26.9MB    2


10. Cómo fixeches para clonar o repositorio

christian@christian-VirtualBox:~/GIT$ git clone https://github.com/csantomevila/repositorio_practica.git
Clonando en 'repositorio_practica'...
remote: Enumerating objects: 6, done.
remote: Counting objects: 100% (6/6), done.
remote: Compressing objects: 100% (3/3), done.
remote: Total 6 (delta 0), reused 0 (delta 0), pack-reused 0 (from 0)
Desempaquetando objetos: 100% (6/6), listo.
christian@christian-VirtualBox:~/GIT$ 


    
12. Cómo engades o arquivo readme2.md

git add README2.md


14. Os pasos a seguir para subir o arquivo que estás editando e o arquivo readme2.md

git add README2.md
git commit README2.md

git push origin main



16. Cómo comprobarías que existen diferencias entre o teu repositorio local e o remote.
Entrega a tarefa enviando na resposta a dirección do teu repositorio coas respostas.

git fetch
git diff origin/main
