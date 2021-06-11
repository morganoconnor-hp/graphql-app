# graphql-app

### Create a Tdodo
mutation createTodo{
  NewTodo(todo: {
    title: "on vas voir?",
    deadline: "06-10-2020",
    description: "TEST to test",
    priority: 1
  }) 
  {
    id
    title
    deadline
    description
    isExecuted
    priority{
      id,
      grade
    }
  }
}

### Get a TODO by Id (here 1)
{
  Todo(id: 1) {
    id,
    title,
    deadline,
    description,
    priority{
      id,
      grade
    }
  }
}


### Get a TODO by Id by query
query getTodo($id: Int!) {
	Todo(id:$id) {
    id,
    title
  }
}

### Get a list of TODOs with limit an criteria (by the priority grade)
{todo_list(limit:5, criteria: "Low") {
  todos {
    id
    title
    deadline
    description
    isExecuted
    priority {
      id
      grade
    }
  }
}}
