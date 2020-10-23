<template>
  <div id="app">
    <div class="ui fixed inverted vue-color">
      <div class="ui container header item">
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
      form: { task: "", prio: "", statut:'', isEdit: false },
      loader: false
    };
  },
  methods: {
    getTasks() {
      this.loader = true;

      axios.get(`${this.url}/tasks`).then(data => {
        this.tasks = data.data;
        this.loader = false;
      });
    },
    deleteTask(id) {
      this.loader = true;

      axios
        .delete(`${this.url}/task/delete/${id}`)
        .then(() => {
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
          task_name: data.task,
          prio: data.prio,
          statut: '0'
        })
        .then(() => {
          this.getTasks();
        })
        .catch(e => {
          alert(e);
        });
    },
    editTask(data) {
      this.loader = true;

      axios
        .put(`${this.url}/task/edit/${data.id}`, {
          task: data.task,
          prio: data.prio,
          statut : data.statut
        })
        .then(() => {
          this.getTasks();
        })
        .catch(e => {
          alert(e);
        });
    },
    onDelete(id) {
      // window.console.log("app delete " + id);

      this.deleteTask(id);
    },
    onEdit(data) {
      // window.console.log("app edit ", data);

      this.form = data;
      this.form.isEdit = true;
    },
    onFormSubmit(data) {
      // window.console.log("app onFormSubmit", data);

      if (data.isEdit) {
        // call edit task
        this.editTask(data);
      } else {
        // call create task
        this.createTask(data);
      }
    }
  },
  created() {
    this.getTasks();
  }
};
</script>
