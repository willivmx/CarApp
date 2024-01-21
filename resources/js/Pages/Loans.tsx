import React, { useEffect } from 'react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import {
  Accordion,
  AccordionContent,
  AccordionItem,
  AccordionTrigger,
} from '@/Components/ui/accordion';
import { Button } from '@/Components/ui/button';
import axios from 'axios';
import { Pencil, Plus, Trash2 } from 'lucide-react';
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import { PageProps } from '@/types';

const Loans = ({ auth }: PageProps) => {
  const [loans, setLoans] = React.useState<any[]>([]);

  const getLoans = async () => {
    const data = await axios.get('/api/loans').then((res) => res.data).catch((err) => console.log(err));
    //invert the array to have the most recent loans first
    data.reverse();
    setLoans(data);
  };

  React.useEffect(() => {
    getLoans();
  }, []);

  const getUser = async (id: number) => {
    const data = await axios.get(`/api/users/${id}`).then((res) => res.data).catch((err) => console.log(err));
    return data;
  };


  // async () => await getCar(loan.car_id).then((res) => res.brand)

  return (
    <DashboardLayout auth={auth}>
      <div className={'w-full flex justify-between items-center px-8 py-4'}>
        <div className={'text-4xl font-extrabold'}><span>Liste des locations</span></div>
        <Dialog>
          <DialogTrigger>
              {auth.user && <Button className={'flex gap-1'}><Plus size={16} />Nouvelle</Button>}
          </DialogTrigger>
          <DialogContent>
            <DialogHeader>
              <DialogTitle>Ajouter une location</DialogTitle>
            </DialogHeader>

          </DialogContent>
        </Dialog>
      </div>
      <div className={'w-full p-10'}>
        {loans.map((loan, index) => (
          <LoanElement loan={loan} key={index} />
        ))}
      </div>
    </DashboardLayout>
  );
};

export default Loans;

const LoanElement = ({ loan }: { loan: any }) => {
  const [car, setCar] = React.useState<any>({});
  const [user, setuser] = React.useState<any>({});
  const getCar = async (id: number) => {
    const data = await axios.get(`/api/cars/${id}`).then((res) => res.data).catch((err) => console.log(err));
    setCar(data);
  };

  const getUser = async (id: number) => {
    const data = await axios.get(`/api/users/${id}`).then((res) => res.data).catch((err) => console.log(err));
    setuser(data);
  };

  useEffect(() => {
    getCar(loan.car_id);
    getUser(loan.user_id);
  }, []);

  return (
    <Accordion type='single' collapsible>
      <AccordionItem value='item-1'>
        <AccordionTrigger>Location N°: #{loan.id}</AccordionTrigger>
        <AccordionContent>
          <div className={'w-full flex flex-col gap-2'}>
            <span>Véhicule: {car.brand} - {car.model} - {car.year} - {car.color}</span>
            <span>Immatriculation: {car.plate_number}</span>
            <span>Client: {user.name}</span>
            <span>Date de location: {loan.location_date}</span>
            <span>Date de retour: {loan.return_date}</span>
          </div>
          <div className={"w-full flex justify-end gap-1.5 pt-8"}>
            <Button className={'bg-red-500 hover:bg-red-600'} onClick={() => {
              axios.delete(`/api/loans/${loan.id}`).then(() => window.location.reload());
            }} size={"sm"}><Trash2 size={16}/> Supprimer</Button>

            <Button size={"sm"} variant={"secondary"}><Pencil size={16}/> Modifier</Button>
          </div>
        </AccordionContent>
      </AccordionItem>
    </Accordion>

  );
};
