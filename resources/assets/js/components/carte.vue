<template>


    <li class="dropdown">
        <a href="#" data-toggle="dropdown" class="dropdown-toggle">Carte ({{ all_prods_count }}) <b class="caret"></b></a>
        <ul class="dropdown-menu" id="menu1">
            <li v-for="prod in prods">
                <div class="row pado_15">
                <div class="col-xs-3"><img :src="prod.image.replace('public','storage')" class="img-responsive"></div>
                <div class="col-xs-6"><a href="#">{{prod.name}}</a></div>
                <div class="col-xs-3"><a href="javascript:" @click="remove_product_cart(prod)"><i class="fa fa-times" aria-hidden="true"></i></a></div>
                </div>
            </li>
        </ul>
    </li>


</template>
<style>
    .sidebar-nav {
    padding: 9px 0;
}

.dropdown-menu .sub-menu {
    left: 100%;
    position: absolute;
    top: 0;
    visibility: hidden;
    margin-top: -1px;
}

.dropdown-menu li:hover .sub-menu {
    visibility: visible;
}

.dropdown:hover .dropdown-menu {
    display: block;
}

.nav-tabs .dropdown-menu, .nav-pills .dropdown-menu, .navbar .dropdown-menu {
    margin-top: 0;
}

.navbar .sub-menu:before {
    border-bottom: 7px solid transparent;
    border-left: none;
    border-right: 7px solid rgba(0, 0, 0, 0.2);
    border-top: 7px solid transparent;
    left: -7px;
    top: 10px;
}
.navbar .sub-menu:after {
    border-top: 6px solid transparent;
    border-left: none;
    border-right: 6px solid #fff;
    border-bottom: 6px solid transparent;
    left: 10px;
    top: 11px;
    left: -6px;
}

 #menu1 {
           width: 268px !important;
      }

      .pado_15{
      padding:15px;
      }

</style>
<script>
    export default{
        mounted() {
                      this.get_carte();
                      this.prods= this.$store.getters.all_prods

                },
      data(){
            return{
            prods:[],
            img:[]
            }
        },
        methods: {
                  get_carte() {
                        this.$http.get('/get_user_cart')
                            .then( (prods) => {

                                  prods.body.forEach( (prod) => {
                                        this.$store.commit('add_prod', prod)
                                  })
                            })
                  },

                   get_image(id) {

                     this.$http.get('/getproductimage/'+id)
                                .then( (respo) => {
                                return respo.body;
                                });

                  },
                  remove_product_cart(prod){

                   this.$http.get('/remove_product_carte/'+prod.id)
                                .then( (respo) => {

                                 if(respo.body==='1'){

                                  this.$store.commit('remove_product', prod);
                                 }
                                });
                  }

            },
            props: ['user_id'],
            computed: {
                  all_prods_count() {
                        return this.$store.getters.all_prods_count
                  },

            }

    }
</script>
