<template>
  <div class="container">
    <h2>Add Task</h2>
    <form action="" method="post">
      <div class="form-group">
        <label for="name">Task Name:</label>
        <input
          type="text"
          class="form-control"
          id="name"
          placeholder="Enter Task Name"
          name="name"
        />
      </div>
      <div class="form-group">
        <label for="pwd">Category:</label>
        <select name="category_id">
          <option selected disabled>Select Category</option>
          <option value=""></option>
        </select>
      </div>
      <button type="submit" class="btn btn-default">Add</button>
    </form>
  </div>
</template>

<script>
export default {};
</script>
