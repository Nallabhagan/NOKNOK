<template>
	
    <div class="card">
        
        <img class="card-img" src="http://placehold.it/300x200" alt="Bologna">
        <div class="card-body">
            <h3 class="card-title">{{ $store.state.interviewTitle }}</h3>
            
            <p class="card-text">{{ $store.state.interviewDescription }}</p>

        </div>
        <!-- <div class="card-footer text-muted d-flex justify-content-between bg-transparent border-top-2 m-0">
            <div class="views">
                <a href="#utf-signin-dialog-block" class="popup-with-zoom-anim log-in-button text-secondry text-underline mr-2 font-weight-bold" style="cursor: pointer;" data-tippy-placement="top" title="Edit Interview">Edit</a>
            </div>
            <div class="stats">
                <a href="#utf-signin-dialog-block" class="popup-with-zoom-anim log-in-button text-secondry text-underline mr-2 font-weight-bold" style="cursor: pointer;" data-tippy-placement="top" title="Edit Interview">Preview</a>
            </div>
        </div> -->
        
    </div>

</template>




<script>

    export default {
        props: ['interview_id'],
        data() {
            return {
                
            }
        },
        created() {
            //disable browser Back
            history.pushState(null, null, location.href);
            window.onpopstate = function () {
                history.go(1);
            };
        	axios.post('./api/question/'+this.interview_id)
        		.then(response => {
                    //store response in store.js as a state
                    this.$store.commit('changeInterviewState', response.data);
	        	}).catch(error => {
	        	    console.log(error);
	        	});
            console.log($store.state.interviewTitle);

        }
        
        
    }
</script>