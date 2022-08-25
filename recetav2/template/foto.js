const xhr = new XMLHttpRequest();

    function onRequestHandler(){
        if(this.readyState === 4 && this.status === 200){
        
        const data = JSON.parse(this.response);
        const img_foto = data.map(item => [item.foto]);
        convert(img_foto);    
    }  

    }
xhr.addEventListener("load", onRequestHandler);
xhr.open('GET','https://autogestion.cmpc.org.ar/appreceta/oracle.php');
xhr.send();

function convert(foto) {
    const foto_hex = foto.toString()
    let foto_img = foto_hex.replace(/[^A-Fa-f0-9]/g, "");
    
    if (foto_img.length % 2) {
        console.log("error hex, largo.");
        return;
    }

    let foto_by = new Array();
    for (let i = 0; i < foto_img.length / 2; i++) {
        let hf = foto_img.substr(i * 2, 2);
        foto_by[i] = parseInt(hf, 16);
    }

    let byteArray_fot_top = new Uint8Array(foto_by);
    let img_foto_top = document.querySelector('.heximagefoto');
    img_foto_top.src = window.URL.createObjectURL(new Blob([byteArray_fot_top], { type: 'application/octet-stream' }));

    let byteArray_fot_lef = new Uint8Array(foto_by);
    let img_foto_lef = document.querySelector('.heximagefotoL');
    img_foto_lef.src = window.URL.createObjectURL(new Blob([byteArray_fot_lef], { type: 'application/octet-stream' }));

   

}