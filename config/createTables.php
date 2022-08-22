<?php

class CreateTables{

	function create($tabela=''){
		$sql = "CREATE TABLE IF NOT EXISTS atributos(
				  `id` INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
				  `nome` varchar(255) NOT NULL,
				  `url` varchar(255) NOT NULL,
				  `descricao` text NOT NULL,
				  `meta_titulo` text NOT NULL,
				  `meta_descricao` text NOT NULL,
				  `palavras_chaves` text NOT NULL,
				  `data_cadastro` datetime NOT NULL,
				  `ultima_atualizacao` datetime NOT NULL,
				  `visitas` int(11) NOT NULL,
				  `status` int(1) NOT NULL DEFAULT '0' COMMENT '0 = Inativo; 1 = Ativo',
				  `excluido` int(1) NOT NULL DEFAULT '0' COMMENT '0 = não excluido; 1 = excluido'
				) ENGINE=InnoDB DEFAULT CHARSET=utf32;

				CREATE TABLE IF NOT EXISTS categorias (
				  `id` int(11) NOT NULL,
				  `id_categoria` int(11) NOT NULL,
				  `ordem` int(11) NOT NULL,
				  `nome` varchar(255) NOT NULL,
				  `url` varchar(255) NOT NULL,
				  `descricao` text NOT NULL,
				  `imagem` varchar(255) NOT NULL,
				  `icone_menu` varchar(255) NOT NULL,
				  `visitas` int(11) NOT NULL,
				  `meta_descricao` text NOT NULL,
				  `meta_title` text NOT NULL,
				  `meta_keys` text NOT NULL,
				  `data_cadastro` datetime NOT NULL,
				  `ultima_atualizacao` datetime NOT NULL,
				  `status` int(1) NOT NULL DEFAULT '0',
				  `excluido` int(1) NOT NULL DEFAULT '0'
				) ENGINE=InnoDB DEFAULT CHARSET=utf32;

				";

		return $sql;
	}

	function create2($tabela=''){
		$sql = "
				CREATE TABLE `".$tabela."`.`atributos` (
				  `id` int(11) NOT NULL,
				  `nome` varchar(255) NOT NULL,
				  `url` varchar(255) NOT NULL,
				  `descricao` text NOT NULL,
				  `meta_titulo` text NOT NULL,
				  `meta_descricao` text NOT NULL,
				  `palavras_chaves` text NOT NULL,
				  `data_cadastro` datetime NOT NULL,
				  `ultima_atualizacao` datetime NOT NULL,
				  `visitas` int(11) NOT NULL,
				  `status` int(1) NOT NULL DEFAULT '0' COMMENT '0 = Inativo; 1 = Ativo',
				  `excluido` int(1) NOT NULL DEFAULT '0' COMMENT '0 = não excluido; 1 = excluido'
				) ENGINE=InnoDB DEFAULT CHARSET=utf32;

				CREATE TABLE `".$tabela."`.`categorias` (
				  `id` int(11) NOT NULL,
				  `id_categoria` int(11) NOT NULL,
				  `ordem` int(11) NOT NULL,
				  `nome` varchar(255) NOT NULL,
				  `url` varchar(255) NOT NULL,
				  `descricao` text NOT NULL,
				  `imagem` varchar(255) NOT NULL,
				  `icone_menu` varchar(255) NOT NULL,
				  `visitas` int(11) NOT NULL,
				  `meta_descricao` text NOT NULL,
				  `meta_title` text NOT NULL,
				  `meta_keys` text NOT NULL,
				  `data_cadastro` datetime NOT NULL,
				  `ultima_atualizacao` datetime NOT NULL,
				  `status` int(1) NOT NULL DEFAULT '0',
				  `excluido` int(1) NOT NULL DEFAULT '0'
				) ENGINE=InnoDB DEFAULT CHARSET=utf32;

				CREATE TABLE `".$tabela."`.`categorias_sub` (
				  `id` int(11) NOT NULL,
				  `id_categoria` int(11) NOT NULL,
				  `id_subcategoria` int(11) NOT NULL,
				  `nome` varchar(255) NOT NULL
				) ENGINE=InnoDB DEFAULT CHARSET=utf32;

				CREATE TABLE `".$tabela."`.`clientes` (
				  `id` int(11) NOT NULL,
				  `nome` varchar(255) NOT NULL,
				  `tipo_pessoa` int(1) NOT NULL DEFAULT '1' COMMENT '1 - Fisica; 2 - Jurídica',
				  `razao_social` varchar(255) NOT NULL,
				  `url` varchar(255) NOT NULL,
				  `cpf` varchar(14) NOT NULL,
				  `rg` varchar(20) NOT NULL,
				  `cnpj` varchar(20) NOT NULL,
				  `i_estadual` varchar(20) NOT NULL,
				  `i_municipal` varchar(20) NOT NULL,
				  `sexo` varchar(50) NOT NULL,
				  `data_nascimento` date NOT NULL,
				  `data_fundacao` date NOT NULL,
				  `telefone_1` varchar(150) NOT NULL,
				  `telefone_2` varchar(150) NOT NULL,
				  `email` varchar(255) NOT NULL,
				  `senha` varchar(255) NOT NULL,
				  `cep` varchar(15) NOT NULL,
				  `rua` varchar(255) NOT NULL,
				  `numero` varchar(50) NOT NULL,
				  `complemento` varchar(255) NOT NULL,
				  `bairro` varchar(255) NOT NULL,
				  `cidade` varchar(255) NOT NULL,
				  `estado` varchar(255) NOT NULL,
				  `pais` varchar(255) NOT NULL,
				  `data_cadastro` datetime NOT NULL,
				  `ultima_atualizacao` datetime NOT NULL,
				  `ultimo_pedido` float(10,2) NOT NULL,
				  `observacoes` text NOT NULL,
				  `status` int(1) NOT NULL DEFAULT '0' COMMENT '0 = Inativo; 1 = Ativo',
				  `excluido` int(1) NOT NULL DEFAULT '0' COMMENT '0 = não excluido; 1 = excluido'
				) ENGINE=InnoDB DEFAULT CHARSET=utf32;

				CREATE TABLE `".$tabela."`.`pedidos` (
				  `id` int(11) NOT NULL,
				  `id_cliente` int(11) NOT NULL,
				  `data` datetime NOT NULL,
				  `nome_cliente` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				  `valor` float NOT NULL,
				  `forma_pagamento` int(11) NOT NULL,
				  `tipo_pagamento` int(11) NOT NULL,
				  `situacao_pagamento` int(11) NOT NULL,
				  `modo_pagamento` int(11) NOT NULL,
				  `bandeira_cartao` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				  `numero_cartao` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				  `nome_cartao` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				  `validade_cartao` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				  `codigo_seguranca` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				  `parcelas_cartao` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				  `email_envio_boleto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				  `cep` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				  `rua` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				  `numero` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				  `complemento` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				  `bairro` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				  `cidade` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				  `estado` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				  `pais` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				  `observacoes` text COLLATE utf8_unicode_ci NOT NULL,
				  `observacoes_entrega` text COLLATE utf8_unicode_ci NOT NULL,
				  `situacao` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				  `status` int(1) NOT NULL DEFAULT '0' COMMENT '0 = Inativo; 1 = Ativo',
				  `excluir` int(1) NOT NULL DEFAULT '0' COMMENT '0 = não excluido; 1 = excluido'
				) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

				CREATE TABLE `".$tabela."`.`pedidos_clientes` (
				  `id` int(11) NOT NULL,
				  `id_pedido` int(11) NOT NULL,
				  `id_cliente` int(11) NOT NULL,
				  `nome` varchar(255) NOT NULL,
				  `tipo_pessoa` int(1) NOT NULL DEFAULT '1' COMMENT '1 - Fisica; 2 - Jurídica	',
				  `razao_social` varchar(255) NOT NULL,
				  `cpf` varchar(14) NOT NULL,
				  `rg` varchar(20) NOT NULL,
				  `cnpj` varchar(20) NOT NULL,
				  `i_estadual` varchar(20) NOT NULL,
				  `i_municipal` varchar(20) NOT NULL,
				  `sexo` varchar(50) NOT NULL,
				  `data_nascimento` date NOT NULL,
				  `data_fundacao` date NOT NULL,
				  `telefone_1` varchar(150) NOT NULL,
				  `email` varchar(255) NOT NULL,
				  `observacoes` text NOT NULL
				) ENGINE=InnoDB DEFAULT CHARSET=utf32;

				CREATE TABLE `".$tabela."`.`pedidos_produto` (
				  `id` int(11) NOT NULL,
				  `id_pedido` int(11) NOT NULL,
				  `id_produto` int(11) NOT NULL,
				  `nome` varchar(255) NOT NULL,
				  `valor` float(10,2) NOT NULL,
				  `desconto` float(10,2) NOT NULL,
				  `quantidade` int(11) NOT NULL
				) ENGINE=InnoDB DEFAULT CHARSET=utf32;

				CREATE TABLE `".$tabela."`.`produtos` (
				  `id` int(11) NOT NULL,
				  `nome` varchar(255) NOT NULL,
				  `sku` varchar(255) NOT NULL,
				  `valor` float(10,2) NOT NULL,
				  `valor_promocional` float(10,2) NOT NULL,
				  `url` varchar(255) NOT NULL,
				  `estoque` int(11) NOT NULL,
				  `disponibilidade` int(1) NOT NULL DEFAULT '0' COMMENT 'em estoque = 1; fora de estoque = 0',
				  `peso` float(10,6) NOT NULL,
				  `altura` float(10,6) NOT NULL,
				  `comprimento` float(10,6) NOT NULL,
				  `largura` float(10,6) NOT NULL,
				  `diferenca_encaixe` float(10,6) NOT NULL,
				  `prazo_postagem` int(11) NOT NULL,
				  `descricao` text NOT NULL,
				  `especificacoes` text NOT NULL,
				  `garantia` text NOT NULL,
				  `data_cadastro` datetime NOT NULL,
				  `visitas` int(11) NOT NULL,
				  `total_em_vendas` float(10,2) NOT NULL,
				  `fabricante` varchar(255) NOT NULL,
				  `meta_descricao` text NOT NULL,
				  `meta_title` text NOT NULL,
				  `meta_keys` text NOT NULL,
				  `ultima_atualizacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
				  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 = Inativo; 1 = Ativo',
				  `excluido` int(11) NOT NULL DEFAULT '0' COMMENT ' 0 = não excluido; 1 = excluido'
				) ENGINE=InnoDB DEFAULT CHARSET=utf32;

				CREATE TABLE `".$tabela."`.`produtos_atributos` (
				  `id` int(11) NOT NULL,
				  `id_produto` int(11) NOT NULL,
				  `id_atributo` int(11) NOT NULL,
				  `nome` varchar(255) NOT NULL,
				  `descricao` text NOT NULL
				) ENGINE=InnoDB DEFAULT CHARSET=utf32;

				CREATE TABLE `".$tabela."`.`produtos_categorias` (
				  `id` int(11) NOT NULL,
				  `id_produto` int(11) NOT NULL,
				  `id_categoria` int(11) NOT NULL
				) ENGINE=InnoDB DEFAULT CHARSET=utf32;

				CREATE TABLE `".$tabela."`.`produtos_imagens` (
				  `id` int(11) NOT NULL,
				  `id_produto` int(11) NOT NULL,
				  `legenda` varchar(255) NOT NULL,
				  `nome` varchar(255) NOT NULL,
				  `extensao` varchar(5) NOT NULL,
				  `tipo` int(1) NOT NULL DEFAULT '0',
				  `principal` int(1) NOT NULL DEFAULT '0',
				  `ordem` int(11) NOT NULL,
				  `status` int(1) NOT NULL DEFAULT '0' COMMENT '0 = Inativo; 1 = Ativo',
				  `excluido` int(1) NOT NULL DEFAULT '0' COMMENT '0 = não excluido; 1 = excluido'
				) ENGINE=InnoDB DEFAULT CHARSET=utf32;

				CREATE TABLE `".$tabela."`.`produtos_relacionados` (
				  `id` int(11) NOT NULL,
				  `id_produto` int(11) NOT NULL,
				  `id_relacionado` int(11) NOT NULL,
				  `nome_produto` varchar(255) NOT NULL
				) ENGINE=InnoDB DEFAULT CHARSET=utf32;

				CREATE TABLE `".$tabela."`.`usuarios` (
				  `id` int(11) NOT NULL,
				  `nome` varchar(255) NOT NULL,
				  `tipo_usuario` int(1) NOT NULL DEFAULT '1' COMMENT '1 = Administrador; 2 = Financeiro; 3 = Vendas; 4 = Estoque',
				  `usuario` varchar(255) NOT NULL,
				  `senha` varchar(255) NOT NULL,
				  `senha_anterior` varchar(255) NOT NULL,
				  `data_cadastro` datetime NOT NULL,
				  `ultima_atualizacao` datetime NOT NULL,
				  `status` int(1) NOT NULL DEFAULT '0' COMMENT '0 = Inativo; 1 = Ativo',
				  `excluido` int(1) NOT NULL DEFAULT '0' COMMENT '0 = não excluido; 1 = excluido'
				) ENGINE=InnoDB DEFAULT CHARSET=utf32;

				CREATE TABLE `".$tabela."`.`usuarios_recuperar_senha` (
				  `id` int(11) NOT NULL,
				  `id_usuario` int(11) NOT NULL,
				  `email` varchar(255) NOT NULL,
				  `hash_recuperacao` varchar(255) NOT NULL,
				  `data_envio` datetime NOT NULL,
				  `data_recuperacao` datetime NOT NULL,
				  `status` int(1) NOT NULL DEFAULT '0' COMMENT '0 = Não utilizado; 1 = Utilizado'
				) ENGINE=InnoDB DEFAULT CHARSET=utf32;

				ALTER TABLE `".$tabela."`.`atributos`
				  ADD PRIMARY KEY (`id`);

				ALTER TABLE `".$tabela."`.`categorias`
				  ADD PRIMARY KEY (`id`);

				ALTER TABLE `".$tabela."`.`categorias_sub`
				  ADD PRIMARY KEY (`id`);

				ALTER TABLE `".$tabela."`.`clientes`
				  ADD PRIMARY KEY (`id`);

				ALTER TABLE `".$tabela."`.`pedidos`
				  ADD PRIMARY KEY (`id`);

				ALTER TABLE `".$tabela."`.`pedidos_clientes`
				  ADD PRIMARY KEY (`id`);

				ALTER TABLE `".$tabela."`.`pedidos_produto`
				  ADD PRIMARY KEY (`id`);

				ALTER TABLE `".$tabela."`.`produtos`
				  ADD PRIMARY KEY (`id`);

				ALTER TABLE `".$tabela."`.`produtos_atributos`
				  ADD PRIMARY KEY (`id`);

				ALTER TABLE `".$tabela."`.`produtos_categorias`
				  ADD PRIMARY KEY (`id`);

				ALTER TABLE `".$tabela."`.`produtos_imagens`
				  ADD PRIMARY KEY (`id`);

				ALTER TABLE `".$tabela."`.`produtos_relacionados`
				  ADD PRIMARY KEY (`id`);

				ALTER TABLE `".$tabela."`.`usuarios`
				  ADD PRIMARY KEY (`id`);

				ALTER TABLE `".$tabela."`.`usuarios_recuperar_senha`
				  ADD PRIMARY KEY (`id`);

				ALTER TABLE `".$tabela."`.`atributos`
				  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

				ALTER TABLE `".$tabela."`.`categorias`
				  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

				ALTER TABLE `".$tabela."`.`categorias_sub`
				  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

				ALTER TABLE `".$tabela."`.`clientes`
				  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

				ALTER TABLE `".$tabela."`.`pedidos`
				  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

				ALTER TABLE `".$tabela."`.`pedidos_clientes`
				  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

				ALTER TABLE `".$tabela."`.`pedidos_produto`
				  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

				ALTER TABLE `".$tabela."`.`produtos`
				  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

				ALTER TABLE `".$tabela."`.`produtos_atributos`
				  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

				ALTER TABLE `".$tabela."`.`produtos_categorias`
				  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

				ALTER TABLE `".$tabela."`.`produtos_imagens`
				  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

				ALTER TABLE `".$tabela."`.`produtos_relacionados`
				  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

				ALTER TABLE `".$tabela."`.`usuarios`
				  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

				ALTER TABLE `".$tabela."`.`usuarios_recuperar_senha`
				  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
				";

		return $sql;
	}
}