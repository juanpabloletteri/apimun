CREATE TABLE `usuarios` (
	`id_usuario` INT NOT NULL AUTO_INCREMENT,
	`usuario` varchar(50) NOT NULL,
	`password` varchar(50) NOT NULL,
	`tipo` INT NOT NULL,
	`activo` INT NOT NULL,
	PRIMARY KEY (`id_usuario`)
);

CREATE TABLE `psicologos` (
	`id_psicologo` INT NOT NULL AUTO_INCREMENT,
	`id_usuario` INT NOT NULL,
	`nombre` varchar(50) NOT NULL,
	`apellido` varchar(50) NOT NULL,
	`mail` varchar(50) NOT NULL,
	`telefono1` varchar(50) NOT NULL,
	`telefono2` varchar(50) NOT NULL,
	PRIMARY KEY (`id_psicologo`)
);

CREATE TABLE `pacientes` (
	`id_paciente` INT NOT NULL AUTO_INCREMENT,
	`id_usuario` INT NOT NULL,
	`id_psicologo` INT NOT NULL,
	`nombre` varchar(50) NOT NULL,
	`apellido` varchar(50) NOT NULL,
	`mail` varchar(50) NOT NULL,
	`telefono1` varchar(50) NOT NULL,
	`telefono2` varchar(50) NOT NULL,
	PRIMARY KEY (`id_paciente`)
);

CREATE TABLE `turnos` (
	`id_turno` INT NOT NULL AUTO_INCREMENT UNIQUE,
	`id_paciente` INT NOT NULL,
	`fecha` DATE NOT NULL,
	`horario` TIME NOT NULL,
	`valor` INT NOT NULL,
	`modalidad` INT NOT NULL,
	PRIMARY KEY (`id_turno`)
);

ALTER TABLE `psicologos` ADD CONSTRAINT `psicologos_fk0` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios`(`id_usuario`);

ALTER TABLE `pacientes` ADD CONSTRAINT `pacientes_fk0` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios`(`id_usuario`);

ALTER TABLE `pacientes` ADD CONSTRAINT `pacientes_fk1` FOREIGN KEY (`id_psicologo`) REFERENCES `psicologos`(`id_psicologo`);

ALTER TABLE `turnos` ADD CONSTRAINT `turnos_fk0` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes`(`id_paciente`);





