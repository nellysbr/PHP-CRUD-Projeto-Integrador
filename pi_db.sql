CREATE DATABASE IF NOT EXISTS natacaounaerp;
USE natacaounaerp;

CREATE TABLE usuarios (
    cod_usuario INT(6) AUTO_INCREMENT, 
    nom_usuario VARCHAR(60) NOT NULL, 
    dtn_usuario DATE NOT NULL, 
    log_usuario VARCHAR(60) NOT NULL, 
    sen_usuario VARCHAR(32) NOT NULL, 
    per_usuario TINYINT(1) NOT NULL, 
    sts_usuario TINYINT(1) NOT NULL,
    PRIMARY KEY(cod_usuario)
);

CREATE TABLE convenios (
	id_convenio INT(6) auto_increment,
    nom_convenio varchar(20),
    PRIMARY KEY(id_convenio)
);

CREATE TABLE atletas (
	id_atleta INT(6) auto_increment,
    nom_atleta varchar(50) not null,
    dti_atleta date not null,
    dtn_atleta date not null,
    nat_atleta varchar(50) not null,
    nac_atleta varchar(20) not null,
    rg_atleta varchar(12) not null,
    cpf_atleta varchar(11) not null,
    sex_atleta char(1) not null, 
    end_atleta varchar(50) not null,
    bai_atleta varchar(25) not null,
    cep_atleta varchar(10) not null,
    cid_atleta varchar(35) not null,
    uf_atleta char(2) not null,
    mae_atleta varchar(50) not null,
    pai_atleta varchar(50),
    clb_atleta varchar(30),
    trb_atleta char(1),
    anx_foto_atleta varchar(100),
    anx_rg_atleta varchar(100),
    anx_cpf_atleta varchar(100),
    anx_atm_atleta varchar(100), 
    anx_cpr_atleta varchar(100),
	id_convenio INT(6),
    primary key(id_atleta)
);

create table provas (
	id_prova int(6) auto_increment,
    nom_prova varchar(30) not null, 
    dt_prova date not null,
    hor_prova varchar(5),
    primary key(id_prova)
);

create table alergias (
	id_alergia int(6) auto_increment,
    nom_alergia varchar(30) not null,
    id_atleta int(6) not null,
    primary key(id_alergia)
);

create table empregos (
	id_emprego int(6) auto_increment,
    nom_empresa varchar(40) not null,
    dti_emprego date not null,
    dtt_emprego date,
    id_atleta int(6) not null,
    primary key(id_emprego)
);

create table telefones (
	id_telefone int(6) auto_increment,
	tip_telefone tinyint(1) not null,
    ddd_telefone int(3) not null,
    num_telefone varchar(12) not null,
    id_atleta int(6) not null,
    primary key(id_telefone)
);

ALTER TABLE atletas ADD CONSTRAINT FOREIGN KEY (id_convenio) REFERENCES convenios(id_convenio);
ALTER TABLE alergias ADD CONSTRAINT FOREIGN KEY (id_atleta) REFERENCES atletas(id_atleta);
ALTER TABLE empregos ADD CONSTRAINT FOREIGN KEY (id_atleta) REFERENCES atletas(id_atleta);
ALTER TABLE telefones ADD CONSTRAINT FOREIGN KEY (id_atleta) REFERENCES atletas(id_atleta);