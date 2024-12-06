# ForumLaravel

**Projeto de fórum** desenvolvido por:

- **Leonardo Negrete**
- **Felipe Salcedo**

**4º ano do curso de Análise e Desenvolvimento de Sistemas (ADS)** na **Fatec Sorocaba**, no modelo de curso AMS. 

---

## Descrição do Projeto

O **Fórum** permite que os usuários:

- Criem **tópicos** para iniciar discussões.
- Comentem em tópicos existentes.
- Organizem os tópicos em **categorias**.
- Adicionem **tags** para especificar o tema do tópico.

Para os administradores, possui um sistema de cadastro de usuários e de categorias para os tópicos.

---

## Tecnologias Utilizadas

### **Backend**
- **Laravel**: Framework PHP utilizado para criar rotas, controladores, validações e a lógica principal da aplicação.
- **MySQL**: Banco de dados relacional utilizado para armazenar e gerenciar os dados do fórum.

### **Frontend**
- **Blade (Template Engine)**: Utilizado para criar views dinâmicas e reutilizáveis.
- **JavaScript e Fetch API**: Para envio de formulários de comentários sem recarregar a página (AJAX).
- **Bootstrap**: Framework CSS para a criação de um design atrativo com componentes estilizados.
- **CSS**: Customização de estilos.

---

## ⚙️ Funcionalidades

### **1. Tópicos**
- Criação de tópicos com título, descrição e status.
- Associação de tópicos a categorias específicas.
- Atribuição de múltiplas tags a cada tópico.

### **2. Comentários**
- Adição de comentários a tópicos por qualquer usuário autenticado.
- Atualização dinâmica da lista de comentários sem recarregar a página.

### **3. Categorias**
- Organização dos tópicos em categorias.
- Exibição de todos os tópicos relacionados a uma categoria específica.

### **4. Tags**
- Adição de tags para especificar o assunto do tópico.

### **5. Sistema de Autenticação**
- Registro e login de usuários.
- Controle de sessão para acessar páginas restritas.