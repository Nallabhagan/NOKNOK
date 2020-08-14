

<template>
    <div class="utf-login-register-page-aera margin-bottom-50">
        <form @submit.prevent="create_interview">
            <div class="utf-submit-field">
                <h5>Interview Title</h5>
                <input type="text" class="utf-with-border" placeholder="Enter Interview Title" v-model="title" :class="{ 'is-invalid': errors.title }" required>
                <span v-if="errors.title" class="invalid-feedback">{{ errors.title }}</span>
            </div>
            <div class="utf-submit-field">
                <h5>Interview Description</h5>
                <textarea question="notes" class="utf-with-border" cols="20" rows="3" placeholder="Enter Interview Description" v-model="description" :class="{ 'is-invalid': errors.description }" required></textarea>
                <span v-if="errors.description" class="invalid-feedback">{{ errors.description }}</span>
            </div>
            <div class="utf-submit-field">
                <h5>Add Questions <small class="text-primary">(Minimum 3 Questions)</small></h5>
                <div v-for="(input,k) in inputs" :key="k">
                    <span style="display: inline-block;width: 92%;">
                        <input class="utf-with-border" type="text" placeholder="Type Question" v-model="input.question" :class="{ 'is-invalid': errors.question }" required>
                    </span>
                    <span style="display: inline-block;font-size: 20px;">
                        <i class="icon-feather-minus-circle text-danger" @click="remove(k)" v-show="k || ( !k && inputs.length > 1)" style="cursor: pointer;"></i>
                        <i class="icon-feather-plus-circle text-success" @click="add(k)" v-show="k == inputs.length-1" style="cursor: pointer;"></i>
                    </span>
                </div>
                <span v-if="errors.question" class="invalid-feedback">{{ errors.question }}</span>
            </div>
            <button class="button full-width utf-button-sliding-icon ripple-effect margin-top-10" type="submit" :disabled="isDisabled" style="font-size: 20px;font-weight: bold;">{{ button_text }} <i class="icon-feather-chevrons-right"></i></button>
        </form>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                title: "",
                description: "",
                questionArray: [],
                inputs: [
                    {
                        question: '',
                    }
                ],
                errors: [],
                button_text: "Create Interview"
            }
        },
        methods: {
            add(index) {
                if(this.inputs[index].question != "") {
                    this.inputs.push({ question: '' });
                } else {
                    alert("Enter Question");
                }
                console.log(this.inputs.length);
            },
            remove(index) {
                this.inputs.splice(index, 1);
            },
            async create_interview() {
                this.button_text = "Creating...";
                this.questionArray = this.inputs.map(function (obj) {
                    return obj.question;
                });
                if(this.checkArray(this.questionArray)) {
                    if(this.questionArray.length >= 3) {
                        let data = {title: this.title,description: this.description,questions: this.questionArray};
                        await axios.post(
                            './api/create-interview', 
                            {
                                title: this.title,
                                description: this.description,
                                question: this.questionArray
                            }
                        ).then(response => {
                            if(response.data.success) {
                                window.location.href = './create-interview?preview='+response.data.interview_token;
                            }
                          }
                        ).catch(error => {
                            this.button_text = "Create Interview";
                            this.errors = error.response.data.errors;
                          }
                        );

                    } else {
                        alert("Enter minimum 3 Questions");
                    }
                } else {
                    alert("Enter All Fields");
                }
            },
            checkArray(my_arr) {
                for(var i=0;i<my_arr.length;i++)
                {
                    if(my_arr[i] === "")   
                    return false;
                }
               return true;
            }
        },
        computed: {
            isDisabled() {
                if(this.inputs.length <= 2 || this.title == "" || this.description == "")
                {
                    return true;
                } else {
                    return false;
                }
                
            }
        }
    }
</script>

