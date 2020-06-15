## Bash Src File Documentation

## Apache Folder

```
This Folder Contient Setup File To Install Apache Http Server
And Start It When Finished Installed It.

```

## Mysql Folder

```
This Folder Also For Setup Mysql Server And Make Setup And Configuration Of Mysql Database
And Finally Add Tables To Database After You Create Database [todos]
Every Thing Will You See During Installation As Message Display When You Start Installation.

```

## Php Folder

```
Thid Folder For Install Php Language And The Connector Between Php And Myasql ,
Additional Install Some Package As A Helper.
```

## SSH Folder

```
This Folder For Install SSH Service If You Want To Access The Os Centos remotely.
```

## Git Folder

```
This Folder If You Want To Load Project Directly From My Github To You Apache Server Folder Whithout
Load By Self But First The [Setup] File Install The [Git] First Then Make A Clone Of The Project.

```

## Monitoring Folder

```

This Specific Folder For Monitoring Your Service Such As [Apache,SSh,Mysql...] After The [Setup] File
Install [Monit] Package Will Do Some Change On The Default [Monitrc] File To Display The Monitoring Of Your Service.
Monitoring username=[admin] , password=[akram123456] Change It From The [Config] File In Monitoring Folder.
This Folder Responsable Of Setup Your Monitoring So In the monitoring sofware i add three modules the first one is the
http server in my case is [apache2] and also i added mysql database , finally i added secure shell to monitoring [ssh]
and if you need more detailes i created a folder its name is image that hold all screen about the project
because the [readme] file doesn't let me display the pictures may be i could added the pictures in
free version so go to the [image] folder and we will see the pictures

```

## Firewall Folder

```
Here I Installed The Firewall Package And Added Port Of [ssh,monitor,apache] To The Firewall
To Access The Server From Outside.

```

### bash.sh

```
Finallay To Run All Files You Need Just To Run [ bash.sh ] File In Home Folder Except [Git ] Folder
Not Include If You Want Add It To This File
and if you want load the project directly to your localserver just run the [Git/setup.sh] file
this [script] is responsble for make a clone of the project from github to your local server

```

### Additionla Info

```
You Can Show The Picture Of Bash src As Monitoring In Image Folder.

```

### Runinig And Setup The Environment

```

To Run The Project You Need To Execute The [bash.sh] script but first you need to load the bashsrc branch to
your local computer and running the previous script
and for the [todos] project you can running the [ setup.sh ] Script in [Git] Folder is automatically load the project
to your server or you can download it by your self .

```
