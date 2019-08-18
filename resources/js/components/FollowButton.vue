<template>
    <div>
        <button class="btn btn-primary ml-4" @click="followUser" v-text="buttonText"></button>
    </div>
</template>

<script>
    export default {

        props: ['userId','follows'], //we receive it from where we call the component (but there is called "user-id"?)

        mounted() {
            console.log('Component mounted.')
        },

        //we want a feedback mechanism that shows us (on the "follow" button) if we are following that user (the default state)
        data:function(){
            return {
                status:this.follows,
            }
        },

        computed: {
            buttonText() {
                return (this.status) ? 'Unfollow' : 'Follow'; //if status is true it means the user is following the profile
            }
        },

        methods: {
            followUser() {
                //alert("Following")   - just to test that the component workes when clicked
                axios.post('/follow/' + this.userId)   //at first we hardcode the route ("axios.post('/follow/1')") just to check it works
                    .then(response=>{
                    this.status = !this.status;
                    console.log(response.data)})  //we can return alert(response.data) or console.log(response.data) for testing
                    .catch(errors => {
                        if(errors.response.status ==401) {   //if the error is of authorization type, send the user to login page
                            window.location='/login'
                        }
                    });
            }
        }
    }
</script>
