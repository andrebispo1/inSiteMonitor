const express = require('express');
const bodyParser = require('body-parser');
const app = express();
const port = 3000;
app.use(bodyParser.json());

const mysql = require('mysql');
const con = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'insitemonitor'
});

con.connect(function (erro) {
    console.log('Conectado ao Banco');
});

app.post('/dadosRecebidos', (req, result) => {

    const dadosRecebidos = req.body;

    for (let i = 0; i < dadosRecebidos.length; i++) {

        let todosDados = dadosRecebidos[i];
        const query = 'SELECT G.GAT_MAC,B.BEACON_MAC FROM GATEWAYS G JOIN BEACONS B ON G.GAT_ID = B.GATEWAY_ID';

        con.query(query, [], (erro, result) => {
            let existeGateway = result.find(mac => mac.gat_mac === dadosRecebidos[0].mac);
            let existeBeacon = result.find(mac => mac.beacon_mac === dadosRecebidos.mac &&
                 beacon_status == true);


            if (existeBeacon) {
                const dateAtual = new Date();
                const ano = dateAtual.getFullYear();
                const mes = dateAtual.getMonth() + 1;
                const dia = dateAtual.getDate();
                const hora = dateAtual.getHours();
                const minuto = dateAtual.getMinutes();
                const segundo = dateAtual.getSeconds();
                const dataFormatada = `${ano}/${mes}/${dia} ${hora}:${minuto}:${segundo}`;

                query = 'INSERT INTO leituras (leitura_date, leitura_type, beacon_id,gateway_id,  bleName, rssi, dados_brutos) VALUES (?, ?, ?, ?, ?, ?,?)';
                const values = [dataFormatada, dados.type, existe.beacon_id, existeGat.gat_id, dados.bledados, dados.rssi, dados.rawData];
                con.query(query, values, (erro) => {
                    if (erro) {
                        console.error('Erro ao inserir os dados', erro);
                        result.status(500).send('Erro');
                        return;
                    } else {
                        console.log("Dados inseridos");
                    };
                });
            };

        });


    };

});
app.listen(port, () => {
    console.log("Conectado ao Servidor");
});
