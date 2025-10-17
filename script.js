document.addEventListener('DOMContentLoaded', function() {
    const addAlunoBtn = document.getElementById('add-aluno-btn');

    if (addAlunoBtn) {
        let alunoIndex = 1;

        addAlunoBtn.addEventListener('click', function() {
            const container = document.getElementById('alunos-container');
            const newAlunoEntry = document.createElement('div');
            newAlunoEntry.classList.add('aluno-entry');

            newAlunoEntry.innerHTML = `
                <h4>Aluno ${alunoIndex + 1}</h4>
                <div class="input-group">
                    <label>Nome do Aluno</label>
                    <input type="text" name="alunos[${alunoIndex}][nome]" required>
                </div>
                <div class="input-group-row">
                    <div class="input-group">
                        <label>Nota 1</label>
                        <input type="number" step="0.1" min="0" max="10" name="alunos[${alunoIndex}][nota1]" required>
                    </div>
                    <div class="input-group">
                        <label>Nota 2</label>
                        <input type="number" step="0.1" min="0" max="10" name="alunos[${alunoIndex}][nota2]" required>
                    </div>
                    <div class="input-group">
                        <label>Nota 3</label>
                        <input type="number" step="0.1" min="0" max="10" name="alunos[${alunoIndex}][nota3]" required>
                    </div>
                </div>
                <div class="input-group">
                    <label>Percentual de Frequência (%)</label>
                    <input type="number" step="1" min="0" max="100" name="alunos[${alunoIndex}][frequencia]" required>
                </div>
            `;
            
            container.appendChild(newAlunoEntry);
            alunoIndex++;
        });
    }
});