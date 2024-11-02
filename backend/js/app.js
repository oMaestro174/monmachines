function MachineMonitoring() {
    const [machines, setMachines] = React.useState([]);
    const [lastUpdate, setLastUpdate] = React.useState(null);
  
    const fetchMachines = () => {
      fetch('get_machines.php')
        .then(response => response.json())
        .then(data => {
          setMachines(data);
          setLastUpdate(new Date().toLocaleString());
        })
        .catch(error => console.error('Erro ao buscar máquinas:', error));
    };
  
    const updateMachineStatus = (machineId, newStatus) => {
      fetch('update_status.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ machine_id: machineId, status: newStatus }),
      })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            fetchMachines();
          } else {
            console.error('Erro ao atualizar status:', data.message);
          }
        })
        .catch(error => console.error('Erro ao atualizar status:', error));
    };
  
    React.useEffect(() => {
      fetchMachines();
      const interval = setInterval(fetchMachines, 5000);
      return () => clearInterval(interval);
    }, []);
  
    return (
      <div>
        <h1>Monitoramento de Máquinas</h1>
        <p>Última atualização: {lastUpdate}</p>
        {machines.map(machine => (
          <div key={machine.id}>
            <h2>Máquina: {machine.name}</h2>
            <p>Status: {machine.status}</p>
            <img src={machine.image_path} alt={machine.status} width="100" />
            <div>
              <button onClick={() => updateMachineStatus(machine.id, 'running')}>Iniciar</button>
              <button onClick={() => updateMachineStatus(machine.id, 'stopped')}>Parar</button>
              <button onClick={() => updateMachineStatus(machine.id, 'maintenance')}>Manutenção</button>
              <button onClick={() => updateMachineStatus(machine.id, 'inactive')}>Inativo</button>
              <button onClick={() => updateMachineStatus(machine.id, 'overload')}>Sobrecarga</button>
            </div>
            <hr />
          </div>
        ))}
      </div>
    );
  }
  
  ReactDOM.render(<MachineMonitoring />, document.getElementById('root'));