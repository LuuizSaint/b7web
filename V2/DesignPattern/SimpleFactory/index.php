<?php
require_once "./NotifyFactory.php";

$notify = new Notify('whats', 'O Factory');

/** Simple Factory
 * O Factory permite que uma classe delegue a criação de objetos a subclasses ou métodos especializados,
 * em precisar saber os detalhes de como esses objetos são instanciados.
 * 
 * Como funciona:
 * A fábrica(classe ou método) define um método que cria instâncias de objetos. 
 * O tipo específico do objeto é determinado em tempo de execução.
 * 
 * Quando utilizar:
 * Quando você precisa criar objetos de diferentes tipos sem depender de um código rígido.
 * Quando o processo de criação é complexo e deve ser centralizado em um único ponto.
 * 
 * Vantagens:
 * Simplifica a criação de objetos.
 * Centraliza a lógica de criação, tornando o código mais flexível e extensível.
 * 
 * Desvantagens:
 * Pode introduzir complexidade excessiva, se mal utilizado.
 * Pode dificultar o teste de unidades individuais.
 */


