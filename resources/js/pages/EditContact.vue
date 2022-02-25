<template>
    <div>
        <div class="container">
            <h2 class="text-center p-2 mt-5 bg-success text-white">Edit Contact</h2>

            <div class="card-body">
                <div class="col-md-6 offset-sm-3">
                    <form id="validateForm" @submit.prevent="updateContact" enctype="multipart/form-data" novalidate>

                    <div class="alert alert-danger" v-if="errors.length">
                        <ul class="mb-0">
                            <li v-for="(error,index) in errors" :key="index">
                                {{ error }}
                            </li>
                        </ul>
                    </div>

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" v-model="contact.name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" v-model="contact.email" class="form-control">
                        </div>
                       <div class="form-group">
                            <label for="designation">Designation</label>
                            <input type="text" id="designation" v-model="contact.designation" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="contact">Contact Number</label>
                            <input type="number" id="contact_no" v-model="contact.contact_no" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="bio">Biography</label>
                            <textarea id="bio" name="bio" cols="20" rows="10" v-model="contact.bio" class="form-control"></textarea>
                        </div>

                        <div class="form-group" v-if="contact.image">
                            <img :src="`${url+'/'+contact.image}`" class="img-responsive" alt="image" width="100" height="150">
                        </div>
                        
                        <div class="form-group">
                            <input type="file" name="image" id="validatedCustomFile" class="custom-file-control" v-on:change="onImageChange">
                            <label class="custom-file-control" for="validatedCustomFile">Choose file....</label>
                        </div>
                        <button class="btn btn-primary mt-4">Edit Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

export default{
    data(){
        return{
            url:document.head.querySelector('meta[name="url"]').content,
            contact:{},
            name:'',
            email:'',
            bio:'',
            designation:'',
            contact_no:'',
            errors:[]
        }
    },
    methods:{ 
        loadData(){
            let url = this.url + `/api/getIDContact/${this.$route.params.id}`;
            this.axios.get(url).then((response)=>{
                this.contact = response.data;
                console.info(this.contact);
            })
        },
        updateContact(){
            if(this.image != ''){
                this.errors=[];
                if(!this.contact.name){
                    this.errors.push('Name is required');
                }
                if(!this.contact.email){
                    this.errors.push('Email is required');
                }
                if(!this.contact.designation){
                    this.errors.push('Designation is required');
                }
                if(!this.image){
                    this.errors.push('Image is required');
                }
                if(!this.contact.contact_no){
                    this.errors.push('Contact number is required');
                }
                if(!this.contact.bio){
                    this.errors.push('Biography is required');
                }

                if(!this.errors.length){
                    let formData = new FormData();
                    let instance = this;
            
                    formData.append('name', this.contact.name);
                    formData.append('email', this.contact.email);
                    formData.append('image', this.image);
                    formData.append('designation', this.contact.designation);
                    formData.append('bio', this.contact.bio);
                    formData.append('contact_no', this.contact.contact_no);

                    let url=this.url + `/api/updateContact/${this.$route.params.id}`;

                    this.axios.post(url, formData).then(function(response){
                        if(response.status){
                            // this.$utils.showSuccess('success', response.message);
                            // Swal.fire({
                            //     icon: 'success',
                            //     title: 'Success',
                            //     text: 'Data berhasil diedit'
                            // })
                            // instance.$router.push({
                            //     name:'contacts'
                            // });
                    
                        }
                        else{
                            // this.$utils.showError('Error', response.message);
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!'
                            })
                        }
                    }).catch((error)=>{
                        this.errors.push(error.response.data.error);
                        console.info(this.errors.push(error.response.data.error));
                    });
                }
            }
         
            this.errors=[];
            if(!this.contact.name){
                this.errors.push('Name is required');
            }
            if(!this.contact.email){
                this.errors.push('Email is required');
            }
            if(!this.contact.designation){
                this.errors.push('Designation is required');
            }
            // if(!this.image){
            //     this.errors.push('Image is required');
            // }
            if(!this.contact.contact_no){
                this.errors.push('Contact number is required');
            }
            if(!this.contact.bio){
                this.errors.push('Biography is required');
            }

            if(!this.errors.length){
                let formData = new FormData();
                let instance = this;
        
                formData.append('name', this.contact.name);
                formData.append('email', this.contact.email);
                // formData.append('image', this.image);
                formData.append('designation', this.contact.designation);
                formData.append('bio', this.contact.bio);
                formData.append('contact_no', this.contact.contact_no);

                let url=this.url + `/api/updateContact/${this.$route.params.id}`;

                this.axios.post(url, formData).then(function(response){
                    if(response.status){
                        // this.$utils.showSuccess('success', response.message);
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Data berhasil diedit'
                        })
                        instance.$router.push({
                            name:'contacts'
                        });
                
                    }
                    else{
                        // this.$utils.showError('Error', response.message);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!'
                        })
                    }
                }).catch((error)=>{
                    this.errors.push(error.response.data.error);
                    console.info(this.errors.push(error.response.data.error));
                });
            }
        
              
        }, onImageChange(e){
            this.image = e.target.files[0];
            console.info(this.image);
        }
    },
    created(){
        this.loadData();
    },
    mounted:function()
    {
            console.info('Edit contacts component loaded');
    }
}

</script>