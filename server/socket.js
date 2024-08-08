const express = require('express');
const http = require('http');
const cors = require('cors')
const app = express();
const server = http.createServer(app);
const io = require("socket.io")(server);

var identifiant;
let notifications=[];
let donnee;
let verificationNbr=0;
let data={};
let cle=0;
let cleTab=[];
let messages=[];
let clients=[];

app.use(express.json());

io.on('connection', (socket) => {
    console.log(socket.id+' user connected');

    socket.on("test", (msg)=>{
        console.log(msg)
        console.log(socket.rooms);
    })

    socket.on("joinRoom", async (id,user_id)=>{
        if(!socket.rooms.has("room-all")){
            socket.join("room-all");
        }
        if(!socket.rooms.has("room-"+id)){
            socket.join("room-"+id);
            io.sockets.in("room-"+id).emit('isConnected', user_id); 
            identifiant=id;
            // console.log(cleTab);
            // console.log(notifications.id);
            let key=3;
            // while(cleTab.length>0){
            //     let key=cleTab.pop();
            //     donnee=notifications.id.cle;
            //     donnee=JSON.stringify(donnee);
            //     setTimeout(function() {
            //         io.sockets.in("room-"+identifiant).emit('receive', donnee)
            //       }, 500);
            //     key--;
            // }
            console.log(`Id ${id} vient de rejoindre le Room`)
        }

    });
    app.use(express.json());
    app.use(express.urlencoded({ extended: false }));
    /* 'form_params' => [
        'user_id' => "demande->user_id",
        'debut' => $demande->debut,
        'fin' =>$demande->fin,
        'status'=>$demande->status,
    ]*/
    app.post('/reception', (req, res) => {
        let id = req.body.user_id;
        cle=req.body.id;
        let debut=req.body.debut;
        let fin=req.body.fin;
        let status=req.body.status;
        let motif =req.body.motif
        data.id=id;
        data.debut=debut;
        data.fin=fin;
        data.status=status;
        data.status=motif;
        let jsonData=JSON.stringify(data);
        /*
        if(verificationNbr==501 ){
            console.log("^^^^^^"+verificationNbr);
            notifications.id['$cle']=data;
            console.log(notifications.id);
        }*/
        io.sockets.in("room-"+req.body.user_id).emit('receive', jsonData);
        cleTab.push("cle");
        notifications.id.cle=data;
        console.log('####'+cleTab)
        res.send('Données reçues avec succès !');
    });
    socket.on("confirmation", (code)=>{
        let jsonCode=JSON.parse(code);
        verificationNbr=jsonCode.id;
            cleTab.pop();
    });
    socket.on('createMessage', (data)=>{
       // list.push(ID);
        //socket.emit('users',list);
        console.log('createMessage', data);
        // io.sockets.in("room-"+data.message_groupe_id).emit('receive', data.contenu);
        // socket.emit('receive', data.contenu);
        // messages["room-"+data.demande] = data;
        io.sockets.in("room-"+data.demande.id).emit('sendMessage', data); 
    });

    socket.on('getPosition', (data)=>{
        
         console.log('getPosition', data);
         
         io.sockets.in("room-"+data.demande.id).emit('sendPosition', data); 
     });

    // socket.on('disconnect', (user_id)=>{
    //     console.log('User '+socket.id+' disconnected');
    //     io.sockets.in("room-"+id).emit('isDisconnected', user_id); 
    // });
});

server.listen(2000, function() {
    console.log('listening on *:2000');
});