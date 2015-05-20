var _smartcoin_api_key = 'pk_test_407d1f51a61756'; //caso já tenha a sua chave, troque-a para a transação aparecer no seu Manage
var headTag = document.getElementsByTagName("head")[0];
var smartTag = document.createElement('script');
smartTag.type = 'text/javascript';
smartTag.async = false;
smartTag.src = 'https://js.smartcoin.com.br/v1/smartcoin.js';
headTag.appendChild(smartTag);