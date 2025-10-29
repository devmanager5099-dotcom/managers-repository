
window.addEventListener("load", ()=>{
    setTimeout( function(){
 
        let inicialPosi = 0;
        const final = 800;
           
        const passo = 1;
        const intervalo = 30;

        const scrollInterval = setInterval(function(){
                
            window.scrollTo(0,  inicialPosi);

             inicialPosi += passo;

             if( inicialPosi >= final){
                clearInterval(scrollInterval);
             }
        },intervalo);
          
    

    },2000);

});