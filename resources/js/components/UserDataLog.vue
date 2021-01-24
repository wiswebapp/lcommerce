<template lang="pug">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">User Data by Vue Js</h3>
      </div>
      <div class="card-body"> 
        <table class="table table-bordered">
            <thead>
                <tr>
                  <th>#</th>
                  <th>User Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in userData" v-bind:key="user.id">
                  <td>{{user.id}}</td>
                  <td>{{user.lname}} {{user.fname}}</td>
                  <td>{{user.email}}</td>
                  <td>{{user.phone}}</td>
                  <td><span class="badge badge-success">{{user.status}}</span></td>
                </tr>
            </tbody>
        </table>
      </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            userData : [],
            user: {
                id: '',
                fname : '',
                lname : '',
                email : '',
                phone : '',
                status : '',
            },
            user_id : '',
            edit : false
        }
    },

    created() {
        this.fetchUserData();
    },

    methods: {
        fetchUserData(){
            fetch('getDashboardUser')
                 .then(res => res.json())
                .then(res => {
                    //console.log(res)
                    this.userData = res.userData;
                })
        }
    }
}
</script>