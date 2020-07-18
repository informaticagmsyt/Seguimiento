Vue.component('hijo',{
    template://html
    ` 
    <div class="bg-success">
    <h1> hijo {{ numero}}<h1>
    </div>
    `,
    props:['numero'],
    mounted(){
        this.$emit('nombreHijo',this.nombre);

    },

    data(){
        return {

        nombre:'Jhonatan'

        }
    }
    
    });