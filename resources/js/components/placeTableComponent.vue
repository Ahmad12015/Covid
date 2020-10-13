<template>
    <div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">الأماكن و المحلات</h4>
                        <p class="card-category"></p>
                    </div>
                    <div class="card-body table-responsive">
                        <div  class="form-group float-left w-25">
                            <label for="exampleInputEmail1">البحث</label>
                            <input type="text" @input="searchMethod()" class="form-control" id="exampleInputEmail1"
                                   v-model="search"  placeholder="رقم الهوية أو اسم المكان">
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>المكان</th>
                                <th>نوع المكان</th>
                                <th>المدينة</th>
                                <th>الحي</th>
                                <th>الشارع</th>
                                <th>صاحب المكان</th>
                                <th>رقم الهوية</th>
                                <th>رقم التواصل</th>
                                <th>تاريخ التسجيل</th>
                                <th>رمز QR</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="place in places" :key="place.id">
                               <td>{{place.id}}</td>
                               <td>{{place.place}}</td>
                               <td>{{place.category}}</td>
                               <td>{{place.city}}</td>
                               <td>{{place.area}}</td>
                               <td>{{place.street}}</td>
                               <td>{{place.name}}</td>
                               <td>{{place.id_number}}</td>
                               <td>{{place.phone}}</td>
                               <td>{{place.created_at}}</td>
                               <td>
                                   <a :href="'/dashboard/place/qr/'+place.id"><button class="btn btn-info">عرض</button></a>
                               </td>
                            </tr>
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li v-for="link in links" class="page-item" :class="link.active?'active':''" :key="link.label">
                                    <a class="page-link" @click.prevent="getplaces(link.url)">
                                        {{link.label}}
                                        <span class="sr-only">{{link.active?'(current)':''}}
                                    </span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "placeTableComponent",
    data(){
        return {
            places: null,
            links: null,
            search:null,
        }
    },
    mounted() {
        this.getplaces();
    },
    methods:{
        getplaces(url = '/dashboard/get_places'){
            axios.get(url)
                .then(res=>{
                    console.log(res)
                    this.places=res.data.data;
                    this.links=res.data.links;
                })
                .catch(err=>{
                    console.log(err);
                })
        },
        searchMethod(){

            axios.get('/dashboard/place/search/'+this.search)
            .then(res=>{
                this.places=res.data.data;
                this.links=res.data.links;
            })
            .catch(err=>{
                console.log(err);
            })
        }
    }
}
</script>

<style scoped>

</style>
