import React from "react";
import axios from "axios";
import { Button, Form } from "react-bootstrap";
import { useFormik } from "formik";
import { useNavigate } from "react-router-dom";

const AddArticle = () => {
  const navigate = useNavigate();

  const formik = useFormik({
    initialValues: {
      title: "",
      content: "",
    },
    onSubmit: (values) => {
      const title = values.title;
      const content = values.content;

      const urlApi = "http://127.0.0.1:8000/api/articles";

      const payload = {
        title: title,
        content: content,
      };

      axios
        .post(urlApi, payload)
        .then((res) => {
          navigate("/");
        })
        .catch((error) => {
          console.log(error);
        });
    },
  });

  return (
    <div className="mt-5">
      <h1 className="text-center">Data Article</h1>

      <div className="mt-2">
        <Form onSubmit={formik.handleSubmit}>
          <Form.Group className="mb-3">
            <Form.Label>Title</Form.Label>

            <Form.Control
              type="text"
              name="title"
              id="title"
              value={formik.values.title}
              onChange={formik.handleChange}
              placeholder="Masukan Judul Artikel"
            />
          </Form.Group>

          <Form.Group className="mb-3">
            <Form.Label>Content</Form.Label>

            <Form.Control
              type="text"
              name="content"
              id="content"
              value={formik.values.content}
              onChange={formik.handleChange}
              placeholder="Masukan Konten Artikel"
            />
          </Form.Group>

          <Button type="submit" variant="primary w-100">
            Tambah Data
          </Button>
        </Form>
      </div>
    </div>
  );
};

export default AddArticle;
