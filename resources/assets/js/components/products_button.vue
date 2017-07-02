<template>
    <div>

        <p>
            <a class="fnt" href="javascript:"  v-if="!loading" @click="add_to_cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
            <a class="fnt" href="javascript:"   v-if="loading"><i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>
                 <span class="sr-only">Loading...</span></a>
            <a class="fnt" href="javascript:"  v-if="favoris==0" @click="add_to_favorite"><i class="fa fa-star-o" ></i></a>
            <a class="fnt" href="javascript:"  v-if="favoris==1" @click="remove_product_favoris"><i class="fa fa-star" ></i></a>
        </p>
    </div>
</template>
<style>
    .fnt{
    font-size: 30px;
    }
</style>
<script>
    export default{

        data(){
            return{

            loading:false
            }
        },
        props: ['product_id','favoris'],
        methods: {
            add_to_cart() {
                 this.loading=true;
                this.$http.get('/add_to_cart/' + this.product_id )
                    .then( (r) => {
                       this.$http.get('/product/'+r.body.product_id)
                            .then( (respo) => {
                            this.$store.commit('add_prod', respo.body);
                            /* Show modal confirmation */
                           this.$swal({
                              text:'Product :('+respo.body.name+') adding to your carte',
                              type: 'success',
                              showCancelButton: true,
                              confirmButtonColor: '#3085d6',
                              cancelButtonColor: '#d33',
                              confirmButtonText: 'Validé le panier',
                              cancelButtonText: 'Continu shopping'
                            }).then(function () {
                                location.href = '/';
                                });
                            /* Fin Show modal confirmation */
                            });
                        this.loading=false;
                    })
            },

            add_to_favorite(){

             this.$http.get('/add_product_to_favoris/'+this.product_id)
                 .then( (respo) => {
                      this.favoris=1;
                     this.$swal({
                              text:'Product :('+respo.body.name+') adding to your favoris',
                              type: 'success',
                              showCancelButton: true,
                              showConfirmButton: false,
                              cancelButtonColor: '#d33',
                              cancelButtonText: 'OK'
                            })

              });

            },
            remove_product_favoris(){

             this.$http.get('/remove_product_favoris/'+this.product_id)
                 .then( (respo) => {
                      this.favoris=0;
              });

            }


        }
    }
</script>
