<template>
    <div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title"></h4>
                    <p class="card-category">آخر تحديث أو إضافة على الجدول كان في<p style="direction: ltr !important;">{{last_update}}</p>
                </div>
                <div class="card-body table-responsive">
                    <form @submit.prevent="save()" v-if="onForm()">
                        <div class="row form-group">
                            <div class="col">
                                <input type="text" class="form-control" v-model="patient.first_name" placeholder="اسم الشخص">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" v-model="patient.father_name"  placeholder="اسم الوالد">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" v-model="patient.granddad_name" placeholder="اسم الجد">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" v-model="patient.last_name" placeholder="اسم العائلة">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col">
                                <input type="text" class="form-control" v-model="patient.id_number" placeholder="رقم البطاقة الشخصية">
                            </div>
                            <div class="col">
                                    <select class="form-control" v-model="patient.gender" data-style="btn btn-link" id="genderFormControlSelect1">
                                        <option disabled selected>الجنس</option>
                                        <option value="male">`ذكر</option>
                                        <option value="female">أنثى</option>
                                    </select>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" v-model="patient.phone" placeholder="رقم المحمول">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col">
                                <input type="text" class="form-control" v-model="patient.city" placeholder="المدينة">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" v-model="patient.area" placeholder="المنطقة">
                            </div>
                           <div class="col" v-if="isHealign()">
                                <input type="date" class="form-control" v-model="patient.date_healing" placeholder="تاريخ الشفاء">
                               <label>تاريخ الشفاء</label>
                            </div>
                            <div class="col" v-if="isInjured()">
                                <input type="date" class="form-control" v-model="patient.date_injury" placeholder="تاريخ الإصابة">
                                <label>تاريخ الإصابة</label>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit" v-if="!patient.id">إضافة</button>
                        <button class="btn btn-primary" type="button" @click.prevent="update()" v-if="patient.id">تعديل</button>
                        <button class="btn btn-primary" @click="removeForm()" v-if="patient.id">إلغاء</button>
                    </form>
                    <div class="d-flex justify-content-start" v-if="isContact()">
                        <div class="w-25">
                            <input type="text"  v-model="contactedId" class="form-control" placeholder="الرقم الشخصي للمختلط به">
                            <div class="panel-footer" v-if="results.length">
                                <ul class="list-group" v-if="modal && contactedId.length">
                                    <li class="list-group-item" @focus="modal=true"  v-for="result in results" @click="setContactedId(result)">{{ result}}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="w-25 mx-2">
                            <input type="text"  v-model="place" class="form-control" placeholder="مكان المخالطة">
                        </div>
                    </div>
                    <div  class="form-group float-left w-25">
                        <label for="exampleInputEmail1">البحث</label>
                        <input type="text" @input="search()" class="form-control" id="exampleInputEmail1"
                               v-model="searchID"  placeholder="أدخل رقم البطاقة الشخصية">
                    </div>
                    <table class="table table-hover">
                        <thead class="text-warning">
                        <th>#</th>
                        <th>الاسم الكامل</th>
                        <th>رقم البطاقة الشخصية</th>
                        <th>الحالة</th>
                        <th>الجنس</th>
                        <th>رقم المحمول(الهاتف)</th>
                        <th>المدينة</th>
                        <th>المنطقة</th>
                        <th v-if="isInjured() || isHealign()">تاريخ الإصابة</th>
                        <th v-if="isHealign()">تاريخ الشفاء</th>
                        <th v-if="isInjured() ">عدد أيام الإصابة</th>
                        <th></th>
                        </thead>
                        <tbody>
                        <tr v-for="patient in this.patients" :key="patient.id" :id="'patient'+patient.id">
                            <td>{{patient.id}}</td>
                            <td @click="goToContactMap(patient.id)"><a href="#">{{patient.first_name+' '+patient.father_name+' '+' '+ patient.granddad_name+ ' '+ patient.last_name}}</a></td>
                            <td @click="goToContactMap(patient.id)"><a href="#">{{patient.id_number}}</a></td>
                            <td>
                                <select class="form-control text-white" data-style="btn btn-link"
                                        :class="[{'bg-success':patient.status=='healthy'?true:false ,
                                        'bg-warning text-dark':patient.status=='contact'?true:false ,
                                        'bg-danger':patient.status=='injured'?true:false}]"
                                        @change="onChange(patient.id,$event)"
                                >
                                    <option class="bg-white text-dark"
                                            :selected="patient.status=='healthy'?'selected':''" value="healthy">معافى</option>
                                    <option class="bg-white text-dark"
                                            :selected="patient.status=='contact'?'selected':''" value="contact">مخالط</option>
                                    <option class="bg-white text-dark"
                                            :selected="patient.status=='injured'?'selected':''" value="injured">مصاب</option>
                                </select>
                            </td>
                            <td>{{patient.gender}}</td>
                            <td>{{patient.phone}}</td>
                            <td>{{patient.city}}</td>
                            <td>{{patient.area}}</td>
                            <td v-if="isInjured() || isHealign()">{{patient.date_injury}}</td>
                            <td v-if="isHealign()">{{patient.date_healing}}</td>
                            <td v-if="isInjured()">{{patient.injury_days}}</td>
                            <td class="td-actions d-flex justify-content-between">
                                <button type="button" rel="tooltip" title="Edit Task"
                                        @click="edit(patient)"
                                        class="btn btn-primary btn-link btn-sm">
                                    <i class="material-icons">edit</i>
                                </button>
                                <button @click="deletePatient(patient.id,patient.name)" type="button" rel="tooltip" title="Remove"
                                        class="btn btn-danger btn-link btn-sm">
                                    <i class="material-icons">close</i>
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li v-for="link in links" class="page-item" :class="link.active?'active':''" :key="link.label">
                                <a class="page-link" @click.prevent="getPatient(link.url)">
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
    name: "PatientTableComponent",
    props:['route'],
    data(){
        return {
            ConditionEdit:false,
            patients:[],
            patient:
                {
                    id:'',
                    first_name:'',
                    father_name:'',
                    granddad_name:'',
                    last_name:'',
                    id_number:'',
                    gender:'',
                    phone:'',
                    status:false,
                    city:'',
                    area:'',
                    date_healing :null,
                    date_injury :null,

                },
            searchID:'',
            links:[],
            last_update:'',
            contactedId: '',
            results: [],
            modal:false,
            place:null,
        }
    },
    mounted() {
        this.getPatient();
            this.check();
    },
    methods:{
        autoComplete(){

            this.results = [];

            if(this.contactedId.length > 0){
                axios.get('/patient/autocomplete/search',{params: {contactedId: this.contactedId}}).then(response => {
                    this.modal=true;
                    this.results = response.data.filter(item => this.contactedId.toLowerCase().indexOf(this.contactedId) > -1);;

                });

            }

        },
        check(){
            if(this.$props.route == '/dashboard/patient/gethealthy'){
                 this.patient.status = 'healthy';
                    return 'healthy';
            }else if(this.$props.route == '/dashboard/patient/getcontact'){
                this.patient.status = 'contact';
                return 'contact';
            }else if(this.$props.route == '/dashboard/patient/getinjured'){
                this.patient.status = 'injured';
                return 'injured';
            }
            this.patient.status = false;
            return false;
        },
        getPatient(url = this.$props.route){
            axios.get(url)
            .then(res=>{
                this.patients=res.data.patients.data;
                this.last_update=res.data.last_update;
                this.links=res.data.patients.links;
            })
            .catch(err=>{
                console.log(err);
            })
        },
        closeModal(){

        },
        deletePatient(id,name){
            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: "لن تتمكن من التراجع عن هذا!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم, احذف العنصر'
            }).then((result) => {
                console.log(result)
                if (result.value) {
                    axios.delete('/patient/'+id)
                    .then(res=>{
                        console.log(this.patients.indexOf(x => {
                            x.id === id
                        }))
                        this.patients.splice(this.patients.map(el=> {return el.id;}).indexOf(id), 1);
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
        onChange(id,event){
            status=event.target.value;
            axios.put('/patient/'+id,{
                status:status
            })
                .then(res=>{
                    if (this.$props.route == '/patient')
                    {
                        var patient=this.patients.find(el=>  el.id === id);
                        patient.status = status;
                        if (patient.status == 'injured')
                        {
                            patient.date_injury = res.data.date;
                            patient.date_healing=null;
                        }
                        else if (patient.status == 'healthy'){
                            patient.date_healing = res.data.date;
                        }
                    }
                    else{
                        this.patients.splice(this.patients.map(el=> {return el.id;}).indexOf(id), 1);
                    }
                    Swal.fire(
                        'تعديل الحالة !',
                        'تم تعديل الحالة بنحاج.',
                        'success'
                    )
                })
                .catch(err=>{
                    console.log(err);
                })

        },
        edit(patient){
                this.patient.id= patient.id,
                this.patient.first_name= patient.first_name,
                this.patient.father_name= patient.father_name,
                this.patient.granddad_name= patient.granddad_name,
                this.patient.last_name= patient.last_name,
                this.patient.id_number= patient.id_number,
                this.patient.gender= patient.gender,
                this.patient.phone= patient.phone,
                this.patient.status= patient.status,
                this.patient.city= patient.city,
                this.patient.area= patient.area,
                this.patient.date_injury = patient.date_injury,
                this.patient.contactedId= this.contactedId,
                this.patient.place= this.place,
            this.ConditionEdit = true;
        },
        removeForm(){
            this.patient=[];
            this.ConditionEdit = false;
            this.patient.status= this.check();
        },
        save(){
            axios.post('/patient',{
                first_name:this.patient.first_name,
                father_name:this.patient.father_name,
                granddad_name:this.patient.granddad_name,
                last_name:this.patient.last_name,
                id_number:this.patient.id_number,
                gender:this.patient.gender,
                phone:this.patient.phone,
                status:this.patient.status,
                city:this.patient.city,
                area:this.patient.area,
                date_injury :this.patient.date_injury,
                contactedId:this.contactedId,
                place:this.place,

            })
            .then(res=>{
                Swal.fire(
                    'إضافة حالة جديدة !',
                    'تم إضافة الحالة بنحاج.',
                    'success'
                )
                this.getPatient();
                this.patient= {
                    status: this.check()
                };
                this.contactedId='';
                this.results=[];
                this.place=null;
            })
        },
        update(){
            axios.post('/patient/update',{
                id:this.patient.id,
                first_name:this.patient.first_name,
                father_name:this.patient.father_name,
                granddad_name:this.patient.granddad_name,
                last_name:this.patient.last_name,
                id_number:this.patient.id_number,
                gender:this.patient.gender,
                phone:this.patient.phone,
                status:this.patient.status,
                city:this.patient.city,
                area:this.patient.area,
                date_injury :this.patient.date_injury,
                date_healing :this.patient.date_healing,
                contactedId:this.contactedId,
                place:this.place,

            })
                .then(res=>{
                    Swal.fire(
                        'تعديل بيانات!',
                        'تم تعديل البيانات بنحاج.',
                        'success'
                    )
                    var patientEdite = this.patients.find(element => element.id == this.patient.id);


                    patientEdite = this.patient;
                    this.patient= {
                        status: this.check()
                    };
                    this.contactedId='';
                    this.results=[];
                    this.place=null;
                    this.ConditionEdit=false
                })
        },
        isInjured(){
            return (this.patient.status === 'injured' || this.patient.status === false);
        },

        isHealign(){
            return (this.patient.status === 'healthy' || this.patient.status === false);
        },
        isContact(){
            return (this.check() == 'contact');
        },
        onForm(){
            if (this.ConditionEdit){
                return true;
            }
            else {
                if (this.route == '/dashboard/patient/gethealthy' || this.patient.status == false) {
                    return false;
                } else {
                    return true;
                }
            }
        },
        search(){
            axios.get('/patient/search/'+this.patient.status+'/'+this.searchID)
            .then(res=>{
                this.patients=res.data.patients.data;
                this.links=res.data.patients.links;
            })
            .catch(err=>{
                console.log(err);
            })
        },
        goToContactMap(id){
            if (id){
                window.location.href='/contact/map/'+id;
            }
        },
        setContactedId(id_number){
            this.contactedId = id_number;
            this.modal=false;
        }

    }
}
</script>

<style scoped>

</style>
