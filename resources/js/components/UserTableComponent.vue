<template>
    <div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">حسابات المشرفين</h4>
                        <p class="card-category"></p>
                    </div>
                    <div>
                        <form @submit.prevent="save()" v-if="add">
                            <div class="row form-group">
                                <div class="col">
                                    <input type="text" id="user_name" class="form-control" name="name" value="" placeholder="الاسم">
                                </div>
                                <div class="col">
                                    <input type="text" id="user_email" class="form-control" name="email" value=""  placeholder="البريد الالكتروني">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary">إضافة</button>
                                    <button type="submit" class="btn btn-primary" @click="function (){add = false;}">إلغاء</button>
                                </div>
                            </div>
                        </form>
                    <div class="m-4">
                        <button type="submit" class="btn btn-primary"  @click="function (){add = true;}" v-if="!add">إضافة مشرف جديد</button>
                    </div>
                    </div>
                    <div>
                        <form @submit.prevent="update()" v-if="this.id">
                            <div class="row form-group">
                                <div class="col">
                                    <input type="text" class="form-control" v-model="name" placeholder="الاسم">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" v-model="email"  placeholder="البريد الالكتروني">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary">تعديل</button>
                                </div>
                            </div>
                        </form>
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
                                <th>الاسم</th>
                                <th>البريد الالكتروني</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="user in users" :key="user.id">
                                <td>{{user.id}}</td>
                                <td>{{user.name}}</td>
                                <td>{{user.email}}</td>
                                <td>
                                    <a ><button class="btn btn-info" @click="editUser(user)">تعديل</button></a>
                                    <a ><button class="btn btn-danger" @click="deleteUser(user.id,user.name)">حذف</button></a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li v-for="link in links" class="page-item" :class="link.active?'active':''" :key="link.label">
                                    <a class="page-link" @click.prevent="getusers(link.url)">
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
    name: "UserTableComponent",
    data(){
        return {
            users: null,
            links: null,
            search:null,
            name:'',
            email:'',
            id:null,
            add:false,
        }
    },
    mounted() {
        this.getusers();
    },
    methods:{
        getusers(url = '/dashboard/get_users'){
            axios.get(url)
                .then(res=>{
                    console.log(res)
                    this.users=res.data.data;
                    this.links=res.data.links;
                })
                .catch(err=>{
                    console.log(err);
                })
        },
        searchMethod(){

            axios.get('/dashboard/user/search/'+this.search)
                .then(res=>{
                    this.users=res.data.data;
                    this.links=res.data.links;
                })
                .catch(err=>{
                    console.log(err);
                })
        },
        editUser(user){
            this.id=user.id;
            this.name= user.name;
            this.email= user.email;
        },
        update(){
            axios.put('/user/'+this.id,{
                'name':this.name,
                'email':this.email,

            })
                .then(res=>{
                    Swal.fire(
                        'تعديل بيانات!',
                        'تم تعديل البيانات بنحاج.',
                        'success'
                    )
                    var userEdite = this.users.find(element => element.id == this.id);

                    userEdite.name = res.data.name;
                    userEdite.email = res.data.email;
                    this.name='';
                    this.id=null;
                    this.email='';
                })
        },
        deleteUser(id,name){
            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: "لن تتمكن من التراجع عن هذا!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم, احذف العنصر'
            }).then((result) => {
                if (result.value) {
                    axios.delete('/user/'+id)
                        .then(res=>{
                            this.users.splice(this.users.map(el=> {return el.id;}).indexOf(id), 1);
                            Swal.fire(
                                'تم الحذف !',
                                'العنصر تم حذفه بنحاح.',
                                'success'
                            )
                        })
                        .catch(err=>{
                            console.log(err)
                        })
                }
            })
        },
        save(){
            axios.post('/user',{
                'name':document.getElementById('user_name').value,
                'email':document.getElementById('user_email').value,
            })
            .then(res=>{
                Swal.fire(
                    'إضافة مشرف!',
                    'تم الإضافة بنحاج.',
                    'success'
                )
                document.getElementById('user_name').value='';
                document.getElementById('user_email').value='';
                this.add=false;
                this.getusers();
            });
        }
    }
}
</script>

<style scoped>

</style>

