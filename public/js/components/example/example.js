Vue.component('example',{
template://html
` 
<div class="bg-dark text-white">
<h1> hola mUndo {{ numeroPadre}}<h1>

<hijo :numero="numeroPadre " @nombreHijo="nombrePadre = $event"></hijo>
</div>
`,

data(){
    return {
        numeroPadre:0,
        nombrePadre:''
    }
}


});