import ListTask from "./components/task/ListComponent.vue";
import EditTask from "./components/task/EditComponent.vue";
import CreateTask from "./components/task/CreateComponent.vue";
import ListTaskCategory from "./components/task-category/ListComponent.vue";
import EditTaskCategory from "./components/task-category/EditComponent.vue";
import CreateTaskCategory from "./components/task-category/CreateComponent.vue";

export const routes = [
  {
    name: "createCategory",
    path: "/taskCategory/create",
    component: CreateTaskCategory,
  },
  {
    name: "listCategory",
    path: "/taskCategory/list",
    component: ListTaskCategory,
  },
  {
    name: "editCategory",
    path: "/taskCategory/edit/:id",
    component: EditTaskCategory,
  },
  {
    name: "createTask",
    path: "/createTask/create",
    component: CreateTask,
  },
  {
    name: "listTask",
    path: "/task",
    component: ListTask,
  },
  {
    name: "editTask",
    path: "/task/edit/:id",
    component: EditTask,
  },
];
