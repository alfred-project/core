
                                                                                                                                            
    
# Job


> La configuración de un trabajo (conjunto de tareas)
>
> 








## Methods

### fromArray
Crea una nueva instancia desde un array con los datos


static **Job::fromArray**(array $values) : [Job](../../../../Job.md)


|Parameters: | | |
| --- | --- | --- |
|array |$values |  |

---


### isStopOnFail
Indica si el trabajo debe detenerse al primer fallo


**Job::isStopOnFail**() : bool



---


### setStopOnFail
Establece si el trabajo debe deternser al primer fallo


**Job::setStopOnFail**(bool $stopOnFail) : [Job](../../../../Job.md)


|Parameters: | | |
| --- | --- | --- |
|bool |$stopOnFail |  |

---


### isAsync
Indica si el trabajo se debe ser asincrono


**Job::isAsync**() : bool



---


### setAsync
Establece si el trabajo debe ser asincrono


**Job::setAsync**(bool $async) : [Job](../../../../Job.md)


|Parameters: | | |
| --- | --- | --- |
|bool |$async |  |

---


### getTasks
Devuelve la lista de Tareas


**Job::getTasks**() : [TaskList](../../../../TaskList.md)



---


### setTasks
Asigna la lista de tareas


**Job::setTasks**([iterable](../../../../iterable.md) $tasks) : [Job](../../../../Job.md)


|Parameters: | | |
| --- | --- | --- |
|[iterable](../../../../iterable.md) |$tasks |  |

---


                                                                                                                                                                                                                                                                                                                                                                                                            
    
                                                                                                                                                                                                                                                                             
                