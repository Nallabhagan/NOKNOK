<template>
    <div class="utf-popup-tab-content-item" id="login">
        <div class="utf-welcome-text-item">
            <h3>Edit Interview</h3>
            <span>{{ $store.state.interviewTitle }}</span>
        </div>
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
                <div class="utf-input-with-icon" v-for="(input,k) in inputs" :key="k">
                    <input class="utf-with-border" type="text" placeholder="Type Question" v-model="input.question" :class="{ 'is-invalid': errors.question }" required>
                    <i class="icon-feather-minus-circle text-danger" @click="remove(k)" v-show="k || ( !k && inputs.length > 1)"></i>
                    <i class="icon-feather-plus-circle text-success" @click="add(k)" v-show="k == inputs.length-1"></i>
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
                button_text: "Edit Interview"
            }
        },
        
        methods: {
            add(index) {
                if(this.inputs[index].question != "") {
                    this.inputs.push({ question: '' });
                } else {
                    alert("Enter Question");
                }
            },
            remove(index) {
                this.inputs.splice(index, 1);
            },
            create_interview() {
                this.button_text = "Submitting...";
                this.questionArray = this.inputs.map(function (obj) {
                    return obj.question;
                });
                if(this.checkArray(this.questionArray)) {
                    if(this.questionArray.length >= 3) {
                        let data = {title: this.title,description: this.description,questions: this.questionArray};
                        axios.post(
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
            },
            interviewData() {
                this.$dispatch('interviewData');
                console.log("working");
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
        },
        created() {
            console.log(this.$store.state.interviewTitle);
        }
        
    }

</script>