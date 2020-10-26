<template>
  <tr>
    <td><input type="checkbox"
       :checked="task.statut"
       :value="task.statut" 
       id="statut"
       @change="check()"></td>
    <td>{{ task.task_name }}</td>
    <td>{{ task.prio_name }}</td>
    <td>
      <button class="btn btn-primary button" @click="onEdit"><span class="material-icons">edit</span></button>
      <button class="btn btn-danger button" @click="onDelete"><span class="material-icons">delete</span></button>
    </td>
  </tr>
</template>

<script>
import axios from "axios";

 
export default {
  name: "Task",
  props: {
    task: {
      type: Object
    }
  },
  methods: {
    onDelete() {
      // window.console.log("task delete " + this.task.id);
      this.$emit("onDelete", this.task.id);
    },
    onEdit() {
      // window.console.log("task edit " + this.task.id);
      this.$emit("onEdit", this.task);
    },
    check(){
      //Checked → change statut
      if(this.task.statut == false){
        this.task.statut = true;
        axios
          .post(`http://localhost/laravel-api/public/api/task/update/${this.task.id}`, {
            statut : "1"
          })
          .catch(e => {
            alert(e);
          });
      }else{
        this.task.statut = false
        axios
          .post(`http://localhost/laravel-api/public/api/task/update/${this.task.id}`, {
            statut : "0"
          })
          .catch(e => {
            alert(e);
          });
      }
    }
  }     //Check priority of the task and change for the name
    
};  

</script>

<style scoped></style>
