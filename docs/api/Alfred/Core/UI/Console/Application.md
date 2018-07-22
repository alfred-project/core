
                                                                                                                                            
    
# Application


> Define como se ejecuta la aplicación desde la linea de comandos
>
> 








## Methods

### getDefaultInputDefinition



protected **Application::getDefaultInputDefinition**() : 



---


### run
Ejecuta la aplicación


**Application::run**([InputInterface](../../../../InputInterface.md) $input = null, [OutputInterface](../../../../OutputInterface.md) $output = null) : int|void


|Parameters: | | |
| --- | --- | --- |
|[InputInterface](../../../../InputInterface.md) |$input |  |
|[OutputInterface](../../../../OutputInterface.md) |$output |  |

---


### buildContainer
Devuelve el contenedor de dependencias


protected **Application::buildContainer**([InputInterface](../../../../InputInterface.md) $input) : [ContainerBuilder](../../../../ContainerBuilder.md)


|Parameters: | | |
| --- | --- | --- |
|[InputInterface](../../../../InputInterface.md) |$input |  |

---


### initCommands
Asigna los commandos definidos en la aplicación
alfred-please init

alfred-please run profile <profile>
alfred-please run job <job>
alfred-please run task <job>:<task>

alfred-please show config

protected **Application::initCommands**() : [Command](../../../../Command.md)[]



---


                                                                                                                                                                                                                                                                                                                                                                                                            
    
                                                                                                                                                                                                                                                                             
                