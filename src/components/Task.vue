<template>
  <tr>
    <td>{{ task.id }}</td>
    <td>{{ task.first_name }} {{ task.last_name }}</td>
    <td>{{ task.email }}</td>
    <td>
      <button class="mini ui blue button" @click="onEdit">Edit</button>
      <button class="mini ui red button" @click="onDelete">Delete</button>
    </td>
  </tr>
</template>

<script>
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
    }
  }
};
</script>

<style scoped></style>
