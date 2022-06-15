import { BrowserRouter, Routes, Route } from "react-router-dom";
import ArticleList from "./components/ArticleList";
import AddArticle from "./components/AddArticle";
import EditArticle from "./components/EditArticle";

import "bootstrap/dist/css/bootstrap.min.css";

function App() {
  return (
    <BrowserRouter>
      <div className="container">
        <Routes>
          <Route path="/" element={<ArticleList />} />
          <Route path="add" element={<AddArticle />} />
          <Route path="edit/:id" element={<EditArticle />} />
        </Routes>
      </div>
    </BrowserRouter>
  );
}

export default App;
