<template>
  <div class="task-list">
    <div class="data">
      <table class="ui celled table">
        <thead>
          <tr>
            <th style="width: 50px; text-align: center;"></th>
            <th>Tâche</th>
            <th>Priorité</th>
            <th style="width: 148px;">Actions</th>
          </tr>
        </thead>

        <tbody>
          <Task
            v-for="task in tasks"
            :key="task.id"
            :task="task"
            @onDelete="onDelete"
            @onEdit="onEdit"
          />
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import Task from "./Task";
export default {
  name: "TaskList",
  components: {
    Task
  },
  props: {
    tasks: {
      type: Array
    }
  },
  methods: {
    onDelete(id) {
      // window.console.log("task list delete " + id);
      this.$emit("onDelete", id);
    },
    onEdit(data) {
      // window.console.log("task list edit " + data);
      this.$emit("onEdit", data);
    }
  }
};
</script>

<style scoped></style>
