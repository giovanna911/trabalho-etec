CREATE DATABASE wda_crud;
USE wda_crud;

CREATE TABLE `enfermeiros` (
  `id` int(11) UNSIGNED NOT NULL,
  `nome` varchar(50) NOT NULL,
  `endereco` varchar(50) NOT NULL,
  `COREN` int(11) NOT NULL,
  `DataNasc` date NOT NULL,
  `foto` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `enfermeiros` (`id`, `nome`, `endereco`, `COREN`, `DataNasc`, `foto`) VALUES
(1, 'Júlia Harumi Nascimento', 'Rua dos bobos, 43', '00001111', '2005-08-16 ', 'harumi.jpg'),
(2, 'lucas tiago', 'Rua dos bananas, 999', '00002222', '2008-05-08 ', 'lucas.jpg'),
(3, 'Kamilly Barbosa', 'Rua dos cantantes, 777', '00003333', '2010-04-18 ', 'kamilly.jpg'),
(4, 'Hariadny Tacashc', 'Rua dos olhudos, 333', '00004444', '2013-02-28 ', 'hariadny.jpg'),
(5, 'Giovanna Marina Henrique ', 'Rua dos sem cabelos, 452', '00005555', '2022-05-21 ', 'giovanna.jpg');


CREATE TABLE `customers` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `cpf_cnpj` varchar(14) NOT NULL,
  `birthdate` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `hood` varchar(100) NOT NULL,
  `zip_code` varchar(8) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(2) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `ie` varchar(15) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `customers` (`id`, `name`, `cpf_cnpj`, `birthdate`, `address`, `hood`, `zip_code`, `city`, `state`, `phone`, `mobile`, `ie`, `created`, `modified`) VALUES
(1, 'Giovanna Marina Gomes', '123.456.789-22', '2022-04-12 ', 'Rua Peixeira Silva, 452', 'Vila ShawMends', '18080550', 'Sorocaba', 'SP', '30310379', '15996023560', '215524', '2016-05-24 00:00:00', '2023-11-26 02:22:06'),
(2, 'Haryalba das Neves', '321.654.987-03', '2006-11-18 ', 'Rua Visconde Nóbrega, 895', 'Carlinho Brown', '18080650', 'Sorocaba', 'SP', '30602457', '15991817258', '237705', '2016-05-24 00:00:00', '2023-11-26 02:22:08');


CREATE TABLE `usuarios` (
  `id` int(11) UNSIGNED NOT NULL,
  `nome` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `usuarios` (`id`, `nome`, `user`, `password`, `foto`) VALUES
(1, 'admin', 'admin', '$2a$08$Cf1f11ePArKlBJomM0F6a.UFZ6Sp2bbz/FEWdXSFF6hx71tGrjUc.', NULL);


ALTER TABLE `enfermeiros`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `enfermeiros`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `customers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `usuarios`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
