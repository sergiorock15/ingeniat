    -- Creamos la Base de datos
    CREATE DATABASE ingeniat;

    -- Tabla de Roles
    CREATE TABLE tblCatRol (    
        dblRol INT (11) NOT NULL AUTO_INCREMENT,
        strRol VARCHAR (50) NOT NULL,
        strDescripcion VARCHAR (100) NOT NULL,        
        PRIMARY KEY (`dblRol`)
    );

    -- Tabla de Usuarios
    CREATE TABLE tblUsuario (    
        dblUsuario INT (11) NOT NULL AUTO_INCREMENT,
        strNombre VARCHAR (50) NOT NULL,
        strApellido VARCHAR (50) NOT NULL,
        strCorreo VARCHAR (50) NOT NULL,
        strPassword VARCHAR (50) NOT NULL,
        dblRol INT (11) NOT NULL,
        PRIMARY KEY (`dblUsuario`),
        FOREIGN KEY (`dblRol`) REFERENCES tblCatRol(`dblRol`)
    );

    -- Tabla de Titulos
    CREATE TABLE tblPublicacion (    
        dblPublicacion INT (11) NOT NULL AUTO_INCREMENT,
        strTitulo VARCHAR (50) NOT NULL,
        strDescripcion TEXT NOT NULL,
        datFecha  DATETIME NOT NULL,
        dblUsuario INT (11) NOT NULL,        
        PRIMARY KEY (`dblPublicacion`),
        FOREIGN KEY (`dblUsuario`) REFERENCES tblUsuario(`dblUsuario`)
    );


    -- Insertamos los datos de los roles
    INSERT INTO 
        `tblcatrol`(`strRol`, `strDescripcion`) 
    VALUES 
        ('Rol basico','Permiso de acceso'),
        ('Rol Medio','Permiso de acceso y consulta'),
        ('Rol Medio Alto','Permiso de acceso y agregar'),
        ('Rol Alto Medio','Permiso de acceso, consulta, agregar y actualizar'),
        ('Rol Alto','Permiso de acceso, consulta, agregar, actualizar y eliminar');
    -- catalogo de usuario
    INSERT INTO 
        `tblusuario`(`strNombre`, `strApellido`, `strCorreo`, `strPassword`, `dblRol`) 
    VALUES 
        ('usuario 1','Apellido 1', 'usuario1@gmail.com', '1234', 1),
        ('usuario 2','Apellido 2', 'usuario2@gmail.com', '1234', 2),
        ('usuario 3','Apellido 3', 'usuario3@gmail.com', '1234', 3),
        ('usuario 4','Apellido 4', 'usuario4@gmail.com', '1234', 4),
        ('usuario 5','Apellido 5', 'usuario5@gmail.com', '1234', 5);

    -- Catalogo de titulos    
    INSERT INTO 
        `tblPublicacion`(`strTitulo`, `strDescripcion`, `datFecha`, `dblUsuario`) 
    VALUES 
        ('Titulo 1','Descripcion 1', '2022-01-01 12:59:59', 1),
        ('Titulo 2','Descripcion 2', '2022-01-01 12:59:59', 1),
        ('Titulo 3','Descripcion 3', '2022-01-01 12:59:59', 1),
        ('Titulo 1','Descripcion 1', '2022-01-01 12:59:59', 2),
        ('Titulo 2','Descripcion 2', '2022-01-01 12:59:59', 2),
        ('Titulo 3','Descripcion 3', '2022-01-01 12:59:59', 2),
        ('Titulo 1','Descripcion 1', '2022-01-01 12:59:59', 3),
        ('Titulo 2','Descripcion 2', '2022-01-01 12:59:59', 3),
        ('Titulo 3','Descripcion 3', '2022-01-01 12:59:59', 3),
        ('Titulo 1','Descripcion 1', '2022-01-01 12:59:59', 4),
        ('Titulo 2','Descripcion 2', '2022-01-01 12:59:59', 4),
        ('Titulo 3','Descripcion 3', '2022-01-01 12:59:59', 4),
        ('Titulo 1','Descripcion 1', '2022-01-01 12:59:59', 5),
        ('Titulo 2','Descripcion 2', '2022-01-01 12:59:59', 5),
        ('Titulo 3','Descripcion 3', '2022-01-01 12:59:59', 5);


        


