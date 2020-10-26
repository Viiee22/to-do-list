<template>
  <div id="app">
    <div class="ui fixed inverted vue-color">
      <div class="ui container title">
        Liste de tâche
      </div>
    </div>

    <div class="ui main container">
      <MyForm :form="form" @onFormSubmit="onFormSubmit" />
      <Loader v-if="loader" /> 
      <TaskList
        :tasks="tasks"
        @onDelete="onDelete"
        @onEdit="onEdit"
      />
    </div>
  </div>
</template>

<script>
require('./assets/css/style.css')
import axios from "axios";
import MyForm from "./components/MyForm";
import TaskList from "./components/TaskList";
import Loader from "./components/Loader";
import Vue from 'vue';

export default {
  name: "App",
  components: {
    MyForm,
    TaskList,
    Loader
  },
  data() {
    return {
      url: "http://localhost/laravel-api/public/api",
      tasks: [],
      form: { task_name: "", prio: "2", statut:'', isEdit: false },
      loader: false
    };
  },
  methods: {
    getTasks() {
      this.loader = true;

      axios.get(`${this.url}/tasks`).then(data => {
        this.tasks = data.data;

        this.checkStatut();
        this.checkPrio();

        this.loader = false;
      });
    },
    deleteTask(id) {
      this.loader = true;

      axios
        .delete(`${this.url}/task/delete/${id}`)
        .then(() => {
          this.clearForm();
          this.getTasks();
        })
        .catch(e => {
          alert(e);
        });
    },
    createTask(data) {
      this.loader = true;

      axios
        .post(`${this.url}/task/add`, {
          task_name: data.task_name,
          prio: data.prio,
          statut: '0'
        })
        .then(() => {
          this.clearForm();
          this.getTasks();
        })
        .catch(e => {
          alert(e);
        });
    },
    editTask(data) {
      this.loader = true;

      axios
        .post(`${this.url}/task/update/${data.id}`, {
          task_name: data.task_name,
          prio: data.prio,
          statut : data.statut
        })
        .then(() => {
          this.clearForm();
          this.getTasks();
        })
        .catch(e => {
          alert(e);
        });
    },
    onDelete(id) {
      this.deleteTask(id);
    },
    onEdit(data) {
      this.form = data;
      this.form.isEdit = true;
    },
    onFormSubmit(data) {
      if (data.isEdit) {
        this.editTask(data);
      } else {
        this.createTask(data);
      }
    },
    checkStatut(){
      this.tasks.forEach(task => {
         if(task.statut == 1){
           task.statut = true;
         }else{
           task.statut = false;
         }
      });
    },
    checkPrio(){
      this.tasks.forEach(task => {
         if(task.prio == '1'){
            Vue.set(task, 'prio_name', 'Haute');
         }
         if(task.prio == '2'){
            Vue.set(task, 'prio_name', 'Normal');
         }
         if(task.prio == '3'){
            Vue.set(task, 'prio_name', 'Basse');
         }
      });
    },
    clearForm(){
      this.form.task_name = '';
      this.form.prio = '2';
      this.form.isEdit = false;
    }
  },
  created() {
    this.getTasks();
  }
};
</script>
