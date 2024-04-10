import { createContext, useContext, useState } from 'react';

const ActiveItemContext = createContext();

export const useActiveItem = () => {
  return useContext(ActiveItemContext);
};

export const ActiveItemProvider = ({ children }) => {
  const [activeItem, setActiveItem] = useState('Dashboard');

  const setItem = (item) => {
    setActiveItem(item);
  };

  return (
    <ActiveItemContext.Provider value={{ activeItem, setItem }}>
      {children}
    </ActiveItemContext.Provider>
  );
};